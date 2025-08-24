@extends('admin.master')
@section('title','Chat Dashboard')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-warning card-outline">
            <div class="card-header">
                <h3 class="card-title">Chat Dashboard</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="list-group">
                            @forelse($chats as $chat)
                            <a href="{{ route('admin.chats.chatForm', $chat->id) }}"
                                class="list-group-item list-group-item-action d-flex align-items-center py-3 px-2 shadow-sm mb-2 rounded"
                                style=" border-left: 5px solid #ffc107;">
                                <img src="{{ FileHelper::get_file_path($chat->image?->path, 'user') }}"
                                    class="img-circle elevation-2 mr-3" alt="User Image" width="48" height="48"
                                    style="object-fit: cover; border: 2px solid #ffc107;">
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted">{{ $chat->name }}</span>
                                        <small class="text-muted">{{
                                            $chat->latest_message->updated_at->diffForHumans()}}</small>
                                        <span title="New Messages" class="badge badge-warning">{{
                                            \App\Models\Message::where('sender',
                                            $chat->id)->where('is_read', false)->count() }}</span>
                                    </div>
                                    <p class="mb-0 text-secondary" style="font-size: 0.95em;">
                                        {{ Str::limit($chat->latest_message->message, 50) }}
                                    </p>
                                </div>
                                @if($chat->unread_count ?? 0)
                                <span class="badge badge-pill badge-danger ml-2">{{ $chat->unread_count
                                    }}</span>
                                @endif
                            </a>
                            @empty
                            <div class="list-group-item text-center">
                                No chats found.
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection