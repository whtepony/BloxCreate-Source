

@extends('master', [
    'pageTitle' => 'Friends',
    'bodyClass' => 'user-friends-page',
    'gridFluid' => true
])

@section('content')
    <h5>Friends</h5>
    <div class="container">
        <div class="grid-x grid-margin-x">
            @forelse ($friendRequests as $friendRequest)
                <div class="cell small-6 medium-2 user-friend mb-25">
                    <a href="{{ route('users.profile', ['id' => $friendRequest->creator->id, 'username' => $friendRequest->creator->username]) }}">
                        <img class="user-friend-avatar" src="{{ $friendRequest->creator->thumbnail() }}">
                    </a>
                    <a href="{{ route('users.profile', ['id' => $friendRequest->creator->id, 'username' => $friendRequest->creator->username]) }}" class="user-friend-username">
                        @if ($friendRequest->creator->online())
                            <div class="user-friend-status status-online" title="{{ $friendRequest->creator->username }} is online" data-tooltip></div>
                        @else
                            <div class="user-friend-status status-offline" title="{{ $friendRequest->creator->username }} is offline" data-tooltip></div>
                        @endif
                        {{ $friendRequest->creator->username }}
                    </a>
                    <div class="push-10"></div>
                    <form action="{{ route('account.friends.update') }}" method="POST" style="display:inline-block;">
                        {{ csrf_field() }}
                        <input type="hidden" name="action" value="accept">
                        <input type="hidden" name="user_id" value="{{ $friendRequest->creator->id }}">
                        <button class="button button-green" type="submit">Accept</button>
                    </form>
                    <form action="{{ route('account.friends.update') }}" method="POST" style="display:inline-block;">
                        {{ csrf_field() }}
                        <input type="hidden" name="action" value="decline">
                        <input type="hidden" name="user_id" value="{{ $friendRequest->creator->id }}">
                        <button class="button button-red" type="submit">Decline</button>
                    </form>
                </div>
            @empty
                <div class="auto cell">You currently have no incoming friend requests.</div>
            @endforelse
        </div>
    </div>
@endsection
