@include('site.layouts.head')
<div class="page-wrapper">
    @yield('content')
    @role('patient')
    <a href="{{ route('chats.chatForm',\App\Models\User::where('name','Admin')->first()) }}" class="chat-fixed">
        <i class="fas fa-comments"></i>
    </a>
    @endrole
</div>
@include('site.layouts.footer')