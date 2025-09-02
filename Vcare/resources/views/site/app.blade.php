@include('site.layouts.head')
<div class="page-wrapper">
    @yield('content')
    @role('patient')
    <?php
    $admin =\App\Models\User::where('name','Admin')->first();
     $unread_count = \App\Models\Message::where('sender', $admin->id)
                ->where('receiver',auth()->id())
                ->where('is_read', false)
                ->count();
    ?>
    <a href="{{ route('chats.chatForm',$admin) }}" class="chat-fixed">
        <i class="fas fa-comments"></i>
        @if($unread_count>0)
        <i title="New Messages" class="badge badge-warning">{{ $unread_count }}</i>
        @endif
    </a>
    @endrole
</div>
@include('site.layouts.footer')