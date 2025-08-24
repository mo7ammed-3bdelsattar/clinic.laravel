@section('content')
<div class="container-fluid">
    <!-- DIRECT CHAT -->
    <div class="card direct-chat direct-chat-warning col-md-12 chat-card" id="chatBox">
        <div class="card-header">
            <h3 class="card-title">Direct Chat With {{ $receiver->name }}</h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body chat-messages" id="chatMessages">
            <!-- Conversations are loaded here -->
            <?php $sender = auth('admin')->user()??auth()->user(); ?>
            @foreach ($messages as $msg)
            <div class="direct-chat-msg {{ $msg->sender === $sender->id ? 'right' : '' }}">
                <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-name {{ $msg->sender === $sender->id ? 'float-right' : 'float-left' }}">{{
                        $msg->sender === $sender->id ? 'You' :
                        $receiver->name }}</span>
                    <span
                        class="direct-chat-timestamp {{ $msg->sender === $sender->id ? 'float-left' : 'float-right' }} message-time"
                        data-time="{{ $msg->created_at }}">{{ $msg->created_at->diffForHumans() }}</span>
                </div>
                <img class="direct-chat-img"
                    src="{{ FileHelper::get_file_path($msg->sender === $sender->id ? $sender->image?->path : $receiver->image?->path, 'user') }}"
                    alt="message user image">
                <div class="direct-chat-text">{{ $msg->message }}</div>
            </div>
            @endforeach

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="input-group">
                <input type="text" name="message" id="message" placeholder="Type Message ..." class="form-control">
                <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
                <span class="input-group-append">
                    <button type="submit" id="send" class="btn btn-warning">Send</button>
                </span>
            </div>
        </div>
        {{-- <div class="card-footer">
            <form action="{{ route('admin.chats.send', $receiver->id) }}" method="post">
                @csrf
                <div class="input-group">
                    <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                    <span class="input-group-append">
                        <button type="submit" class="btn btn-warning">Send</button>
                    </span>
                </div>
            </form>
        </div> --}}
        <!-- /.card-footer-->
    </div>
    <!--/.direct-chat -->
</div>
<!-- /.col -->
@endsection

@push('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
@vite('resources/css/app.css')

<style>
    .chat-card {
        height: calc(100vh - 190px);
        /* المساحة المتبقية من الصفحة */
        display: flex;
        flex-direction: column;
    }

    .chat-messages {
        flex: 1;
        overflow-y: auto;
    }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/dayjs/dayjs.min.js"></script>
<script src="https://unpkg.com/dayjs/plugin/relativeTime.js"></script>
<script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.15.0/echo.iife.js"></script>
<script>
    dayjs.extend(window.dayjs_plugin_relativeTime);

function updateTimes() {
    document.querySelectorAll('.message-time').forEach(el => {
        let time = el.getAttribute('data-time');
        el.textContent = dayjs(time).fromNow();
    });
}
updateTimes();
setInterval(updateTimes, 60000);

function scrollToBottom() {
    const chat = document.getElementById('chatMessages');
    chat.scrollTop = chat.scrollHeight;
}
window.addEventListener('load', scrollToBottom);

// إرسال الرسالة
document.getElementById('send').addEventListener('click', function () {
    const input = document.getElementById('message');
    const text = (input.value || '').trim();
   
    if (!text) return;

    fetch('{{ route(auth('admin')->user() ? 'admin.chats.send' : 'chats.send', $receiver->id) }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ message: text })
    }).catch(err => console.error(err));
     var me = {{ auth('admin')->user()->id ?? auth()->user()->id }};


    input.value = '';
});
const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
    cluster: '{{ env('PUSHER_APP_CLUSTER', 'mt1') }}',
});
    var me = {{ auth('admin')->user()->id ?? auth()->user()->id }};
    var receiver = document.querySelector('input[name="receiver_id"]').value;

    const CHANNEL_NAME = `chat.${Math.min(me, receiver)}.${Math.max(me, receiver)}`;
    const channel = pusher.subscribe(CHANNEL_NAME);
    console.log('Subscribing to channel:', channel);

    channel.bind('pusher:subscription_succeeded', function() {
    console.log("Subscribed!");
    });
 



channel.bind('message.sent', function(e) {
    var msg= e;
    console.log('📩 Received message:', msg);
    var user = {{ auth('admin')->user()->id ?? auth()->user()->id }};
    var isMe = parseInt(msg.sender) === user;

    const msgHtml = `
        <div class="direct-chat-msg ${isMe ? 'right' : ''}">
            <div class="direct-chat-infos clearfix">
                <span class="direct-chat-name ${isMe ? 'float-right' : 'float-left'}">
                    ${isMe ? 'You' : (msg.sender_name ?? 'User')}
                </span>
                <span class="direct-chat-timestamp ${isMe ? 'float-left' : 'float-right'} message-time"
                      data-time="${msg.sent_at}">
                    ${dayjs(msg.sent_at).fromNow()}
                </span>
            </div>
            <img class="direct-chat-img" src="${msg.image}" alt="message user image">
            <div class="direct-chat-text">${msg.message}</div>
        </div>
    `;

    document.getElementById('chatMessages').insertAdjacentHTML('beforeend', msgHtml);
    scrollToBottom();
    updateTimes();
});

</script>

@endpush