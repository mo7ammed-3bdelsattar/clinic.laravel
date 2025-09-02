<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Services\ChatService;
use App\Http\Controllers\Controller;
use Flasher\Prime\Translation\Messages;

class MessageController extends Controller
{
    public function index()
    {
        ChatService::checkAccess();
        $chats = ChatService::getChatList(auth('admin')->user()->id ?? auth()->id());
        return view('admin.pages.chats.index', compact('chats'));
    }
    public function chatForm($id)
    {
        ChatService::checkAccess();
        $receiver = User::with(['image', 'roles'])->whereHas('patient')->find($id);
        if (!$receiver) {
            $receiver = User::with('image')->whereHas('admin.roles')->findOrFail($id);
        }
        $messages = ChatService::getMessages(receiver: $receiver);
        if (auth('admin')->check()) {
            return view('admin.pages.chats.chat', [
                'receiver' => $receiver,
                'messages' => $messages,
            ]);
        } else {
            return view('site.pages.chat', [
                'receiver' => $receiver,
                'messages' => $messages,
            ]);
        }
    }

    public function send(Request $request, User $receiver)
    {
        ChatService::checkAccess();
        $request->validate([
            'message' => 'required|string|max:255',
        ]);
        $sender = auth('admin')->user()->id ?? auth()->user()->id;

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
