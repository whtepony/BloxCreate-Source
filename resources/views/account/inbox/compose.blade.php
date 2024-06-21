

@extends('master', [
    'pageTitle' => 'Compose Message',
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
            <a href="{{ route('account.inbox.compose', ['username' => $user->username]) }}">Compose</a>
        </div>
    </div>
    <div class="container">
        <form action="{{ route('account.inbox.compose.store') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <input class="form-input" type="text" name="title" placeholder="Title">
            <textarea class="form-input" name="body" placeholder="Write your message here." rows="5"></textarea>
            <button class="inbox-button" type="submit">Send</button>
        </form>
    </div>
@endsection
