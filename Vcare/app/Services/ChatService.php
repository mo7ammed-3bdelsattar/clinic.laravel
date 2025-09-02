<?php

namespace App\Services;

use App\Models\User;
use App\Models\Admin;
use App\Models\Message;

class ChatService
{

    public static function getChatList($userId)
    {
        $sender = auth('admin')->user()->id ?? auth()->id();
        $chats = User::where('type', '4')
            ->whereHas('messages', function ($q) use ($sender) {
                $q->where(function ($qq) use ($sender) {
                    $qq->where('sender', $sender)
                        ->orWhere('receiver', $sender);
                });
            })
            ->with('image')
            ->get();
        $chats = $chats->map(function ($chat) use ($sender) {
            $chat->latest_message = Message::where(function ($q) use ($chat, $sender) {
                $q->where('sender', $chat->id)
                    ->orWhere('sender', $sender);
            })
                ->orderBy('created_at', 'desc')
                ->first();
            $chat->unread_count = Message::where('sender', $chat->id)
                ->where('receiver', $sender)
                ->where('is_read', false)
                ->count();
            return $chat;
        });
        return $chats;
    }
    public static function getMessages($receiver){
        $sender = auth('admin')->user()->id ?? auth()->id();
        $messages = Message::with('user', 'user.image')->where(function ($q) use ($receiver, $sender) {
            $q->where('sender', $sender)
                ->where('receiver', $receiver->id)
                ->orWhere(function ($q2) use ($receiver, $sender) {
                    $q2->where('sender', $receiver->id)
                        ->where('receiver', $sender);
                });
        })
            ->orderBy('created_at', 'asc')
            ->get();
            Message::where('sender', $receiver->id)
                ->where('receiver', $sender)
                ->update(['is_read' => true]);
        return $messages;
    }
    public static function checkAccess(){
        if (auth('admin')->check()) {
            $auth = Admin::where('user_id', auth('admin')->user()->id)->with( 'roles')->first()?? abort(403, 'Unauthorized');
            abort_if(!$auth->hasRole('admin'), 403);
        }else {
            abort_if(!auth()->user()->hasRole('patient'), 403);
        }
    }
}
