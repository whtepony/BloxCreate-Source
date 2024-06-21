

@extends('master', [
    'pageTitle' => $message->title,
    'bodyClass' => 'inbox-page'
])

@section('content')
    <div class="inbox-navigation">
        <div class="inbox-navigation-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </div>
        <div class="inbox-navigation-item">
            <a href="{{ route('account.inbox.index') }}">Inbox</a>
        </div>
        <div class="inbox-navigation-item">
            <a href="{{ route('account.inbox.show', ['id' => $message->id]) }}">{{ $message->title }}</a>
        </div>
    </div>
    <div class="container">
        <div class="grid-x grid-margin-x">
            <div class="cell small-4 medium-2 text-center">
                <div class="inbox-show-message-sender-avatar">
                    <a href="{{ route('users.profile', ['id' => $message->creator->id, 'username' => $message->creator->username]) }}">
                        <img class="inbox-show-message-sender-avatar-image" src="{{ ($message->creator->id == 1) ? storage('web-img/icon.png') : $message->creator->headshot() }}">
                    </a>
                </div>
                <a href="{{ route('users.profile', ['id' => $message->creator->id, 'username' => $message->creator->username]) }}" class="inbox-show-message-sender-username">{{ $message->creator->username }}</a>
            </div>
            <div class="cell small-8 medium-10">
                <div class="grid-x grid-margin-x">
                    <div class="auto cell">
                        <div class="inbox-show-message-title">{{ $message->title }}</div>
                    </div>
                    @if ($message->sender_id != Auth::user()->id)
                        <div class="shrink cell">
                            <a href="{{ route('account.inbox.reply', ['id' => $message->id]) }}" class="button button-blue">Reply</a>
                        </div>
                    @endif
                </div>
                @if ($message->receiver_id == Auth::user()->id)
                    <div class="inbox-show-message-received">Received {{ $message->created_at->diffForHumans() }}</div>
                @else
                    <div class="inbox-show-message-received">Sent {{ $message->created_at->diffForHumans() }}</div>
                @endif
                <hr class="inbox-show-message-divider">
                @if ($message->sender_id == 1 && $message->body == '[welcome]')
                <div class="inbox-show-message-body">
                Welcome to BLOXCity, {{ $message->receiver->username }}!
                <br><br>
                Please make sure you follow our terms of service at all times to avoid a suspension on your account, you can
                view our terms of service here: <a href="https://bloxcity.co/notes/terms">https://bloxcity.co/notes/terms</a>.<br><br> 
                Don't forget to also join our official discord server to keep
                up to date on updates, news and more: <a href="https://discord.gg/dWy4gvspj5">https://discord.gg/dWy4gvspj5</a>.
                <br><br>
                Sincerely,<br>
                BLOX City
                </div>
                @else
                <div class="inbox-show-message-body">{!! nl2br(e($message->body)) !!}</div>
                @endif
            </div>
        </div>
    </div>
@endsection
