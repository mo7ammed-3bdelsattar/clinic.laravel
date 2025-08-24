<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function index()
    {
        $chats = User::with('image')->where('type', '4')->with('image')->get();
        $sender = auth('admin')->user()->id ?? auth()->id();

        $chats = $chats->map(function ($chat) use ($sender) {
            $chat->latest_message = Message::where(function ($q) use ($chat, $sender) {
                $q->where('receiver', $chat->id)
                    ->where('sender', $sender);
            })
                ->orderBy('created_at', 'desc')
                ->first();
            return $chat;
        });
        return view('admin.pages.chats.index', compact('chats'));
    }
    public function chatForm($id)
    {
        $sender = auth('admin')->user()->id ?? auth()->id();
        $receiver = User::with('image')->findOrFail($id);
        $messages = Message::where(function ($q) use ($receiver, $sender) {
            $q->where('sender', $sender)
                ->where('receiver', $receiver->id)
                ->orWhere(function ($q2) use ($receiver, $sender) {
                    $q2->where('sender', $receiver->id)
                        ->where('receiver', $sender);
                });
        })
            ->orderBy('created_at', 'asc')
            ->get();
        if (auth('admin')->check()) {
            return view('admin.pages.chats.chat', [
                'receiver' => $receiver,
                'messages' => $messages,
            ]);
        }else {
            return view('site.pages.chat', [
                'receiver' => $receiver,
                'messages' => $messages,
            ]);
        }
    }

    public function messages(User $receiver)
    {
        $sender = auth('admin')->user()->id ?? auth()->id();
        $messages = Message::where(function ($q) use ($receiver, $sender) {
            $q->where('sender', $sender)
                ->where('receiver', $receiver->id);
        })
            ->orderBy('created_at', 'asc')
            ->get();
        return [
            'receiver' => $receiver,
            'messages' => $messages,
        ];
    }

    public function send(Request $request, User $receiver)
    {
        $request->validate([
            'message' => 'required|string|max:255',
        ]);
        $sender = auth('admin')->user()->id ?? auth()->user()->id;
        if (!$sender) {
            $sender = $request->sender;
        }
        $message = Message::create([
            'sender' => $sender,
            'receiver' => $receiver->id,
            'message' => $request->message,
            'is_read' => false,
            'sent_at' => now(),
        ]);
        try {
            broadcast(new \App\Events\MessageSent($message, $receiver, User::find($sender)))->toOthers();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        return response()->json(['success' => 'Message sent successfully.', 'message' => $message], 200);
    }
}
