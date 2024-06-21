

@extends('master', [
    'pageTitle' => 'Inbox',
    'bodyClass' => 'inbox-page'
])

@section('content')
    <div class="tabs inbox-tabs">
        <div class="tab">
            <a href="{{ route('account.inbox.index', ['sort' => 'incoming']) }}" class="tab-link @if (request()->sort == 'incoming') active @endif">Incoming</a>
        </div>
        <div class="tab">
            <a href="{{ route('account.inbox.index', ['sort' => 'sent']) }}" class="tab-link @if (request()->sort == 'sent') active @endif">Sent</a>
        </div>
        <div class="tab">
            <a href="{{ route('account.inbox.index', ['sort' => 'history']) }}" class="tab-link @if (request()->sort == 'history') active @endif">History</a>
        </div>
    </div>
    <div class="inbox-messages">
        @forelse ($messages as $message)
            <div class="inbox-container @if ($message->seen) is-seen @endif">
                <div class="inbox-message-sender-avatar">
                    {{-- @if (request()->sort == 'incoming' && $message->receiver_id == Auth::user()->id) --}}
                        <img class="inbox-message-sender-avatar-image" src="{{ ($message->creator->id == 1) ? storage('web-img/icon.png') : $message->creator->headshot() }}">
                    {{-- @else
                        <img class="inbox-message-sender-avatar-image" src="{{ ($message->receiver->id == 1) ? storage('web-img/icon.png') : $message->receiver->headshot() }}">
                    @endif --}}
                </div>
                <div class="inbox-message-details">
                    <a href="{{ route('account.inbox.show', ['id' => $message->id]) }}" class="inbox-message-title">{{ $message->title }}</a>
                    {{-- @if (request()->sort == 'incoming' && $message->receiver_id == Auth::user()->id) --}}
                        <div class="inbox-message-sender">from <a href="{{ route('users.profile', ['id' => $message->creator->id,'username' => $message->creator->username]) }}">{{ $message->creator->username }}</a> {{ $message->created_at->diffForHumans() }}</div>
                    {{-- @else
                        <div class="inbox-message-sender">to <a href="{{ route('users.profile', ['id' => $message->receiver->id, 'username' => $message->receiver->username]) }}">{{ $message->receiver->username }}</a> {{ $message->created_at->diffForHumans() }}</div>
                    @endif --}}
                </div>
            </div>
        @empty
            <div class="container inbox-container" style="padding-bottom:15px;">
                <p>{{ $string }}</p>
            </div>
        @endforelse
    </div>
    {{ $messages->onEachSide(1)->links('pagination.default') }}
@endsection
