

@extends('master', [
    'pageTitle' => 'Reply to Message',
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
            <a href="{{ route('account.inbox.reply', ['id' => $message->id]) }}">Reply</a>
        </div>
    </div>
    <div class="container">
        <div class="inbox-quote">
            <div class="forum-quote-body">{!! nl2br(e($message->body)) !!}</div>
            <div class="forum-quote-footer"><a href="{{ route('users.profile', ['id' => $message->creator->id, 'username' => $message->creator->username]) }}">{{ $message->creator->username }}</a>, {{ $message->created_at->format('m-d Y h:i A') }}</div>
        </div>
        <form action="{{ route('account.inbox.reply.store') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="message_id" value="{{ $message->id }}">
            <textarea class="form-input" name="body" placeholder="Write your message here." rows="5"></textarea>
            <button class="inbox-button" type="submit">Send</button>
        </form>
    </div>
@endsection
