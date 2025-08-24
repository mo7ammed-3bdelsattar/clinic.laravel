<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Booking;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

/**
 * Class AdminDashboardController
 * @package App\Http\Controllers\Admin
 */
class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function __invoke(Request $request)
    {
        abort_if(Gate::allows('patient'),403);
        $lastMembers=User::with('image')->latest()->take(4)->get();
        $sender = auth('admin')->user()->id ?? auth()->id();
        
        $count=count($lastMembers);
        $bookings = Booking::with('patient','patient.user','doctor.user')->paginate(10);
        $chats = User::where('type', '4')->with('image')->get();
        $chats = $chats->map(function ($chat) use ($sender) {
            $chat->latest_message = Message::where(function ($q) use ($chat, $sender) {
                $q->where('receiver', $chat->id)
                    ->where('sender', $sender);
            })
                ->orderBy('created_at', 'desc')
                ->first();
            return $chat;
        });
        // dd($chats); 

        return view('admin.pages.dashboard.dashboard', compact('lastMembers','count','bookings','chats'));
    }
}