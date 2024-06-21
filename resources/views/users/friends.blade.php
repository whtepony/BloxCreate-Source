@extends('master', [
    'pageTitle' => $user->username . '\'s Friends',
    'bodyClass' => 'user-friends-page',
    'gridFluid' => true
])

@section('content')
    <h5>{{ $user->username }}'s Friends</h5>
    <div class="container">
        <div class="grid-x grid-margin-x">
            @forelse ($friends as $friend)
                <div class="cell small-6 medium-2 user-friend mb-25">
                    <a href="{{ route('users.profile', ['id' => $friend->id, 'username' => $friend->username]) }}">
                        <img class="user-friend-avatar" src="{{ $friend->thumbnail() }}">
                    </a>
                    <a href="{{ route('users.profile', ['id' => $friend->id, 'username' => $friend->username]) }}" class="user-friend-username">
                        @if ($friend->online())
                            <div class="user-friend-status status-online" title="{{ $friend->username }} is online" data-tooltip></div>
                        @else
                            <div class="user-friend-status status-offline" title="{{ $friend->username }} is offline" data-tooltip></div>
                        @endif
                        {{ $friend->username }}
                    </a>
                </div>
            @empty
                <div class="auto cell">This user has no friends.</div>
            @endforelse
        </div>
        {{ $friends->onEachSide(1)->links('pagination.default') }}
    </div>
@endsection
