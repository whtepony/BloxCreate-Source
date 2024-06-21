

@extends('master', [
    'pageTitle' => 'Games',
    'bodyClass' => 'games-page',
    'gridClass' => 'games-grid'
])

@section('content')
    <div class="games-header">Games</div>
    <div class="container">
        <div class="grid-x grid-margin-x">
            @forelse ($games as $game)
                <div class="cell small-6 medium-2 game">
                    <a href="{{ route('games.show', ['id' => $game->id]) }}">
                        <img class="game-image" src="{{ storage($game->thumbnail_url) }}">
                    </a>
                    <a href="{{ route('games.show', ['id' => 1]) }}" class="game-name">{{ $game->title }}</a>
                    <div class="game-creator">Created By: <a href="{{ route('users.profile', ['id' => $game->creator->id, 'username' => $game->creator->username]) }}">{{ $game->creator->username }}</a></div>
                    <div class="game-playing">N/A playing</div>
                </div>
            @empty
                <div class="cell auto">There are currently no active games.</div>
            @endforelse
        </div>
    </div>
@endsection
