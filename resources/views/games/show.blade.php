

@extends('master', [
    'pageTitle' => $game->title,
    'pageDescription' => $game->title . ' is a game on ' . config('app.name') . ', a free creative gaming platform designed for kids and teenagers. Play today!',
    'pageImage' => storage($game->thumbnail_url),
    'bodyClass' => 'game-page',
    'gridClass' => 'game-grid'
])

@section('additional_js')
    <script>
        var csk = null;

        $(function() {
            $('[data-play]').click(function() {
                if (!userData.authenticated) {
                    window.location = '/login';
                } else {
                    if (csk == null) {
                        $.post('/games/generate-token', {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            id: {{ $game->id }}
                        }).done(function(data) {
                            csk = data.csk;
                            console.log(`[DEBUG] CSK: ${csk}`);
                        }).fail(function() {
                            // window.location = '?gameError=token';
                        });
                    }

                    window.location.assign(`blox-city-client://` + token);
                }
            })
        });
    </script>
@endsection

@section('content')
    <div class="modal reveal" id="error-modal" data-reveal>
        <div class="modal-title">Oops</div>
        <div class="modal-content">
            <p>Something went wrong. Please refresh and try again.</p>
        </div>
        <div class="modal-footer">
            <div class="modal-buttons">
                <button class="modal-button" onclick="window.location.reload();">REFRESH</button>
                <button class="modal-button" data-close>CANCEL</button>
            </div>
        </div>
    </div>
    <div class="game-header">{{ $game->title }}</div>
    <div class="container">
        <div class="grid-x grid-margin-x">
            <div class="cell medium-8">
                <img class="game-image" src="{{ storage($game->thumbnail_url) }}">
            </div>
            <div class="cell medium-4">
                <a href="{{ route('users.profile', ['id' => $game->creator->id, 'username' => $game->creator->username]) }}">
                    <div class="game-creator-avatar">
                        <img class="game-creator-avatar-image" src="{{ ($game->creator->headshot() }}">
                    </div>
                </a>
                <div class="game-play-button-holder">
                    <div class="game-play-button" data-play>Play</div>
                </div>
            </div>
        </div>
        <div class="grid-x grid-margin-x">
            <div class="cell small-6 medium-3 game-statistic">
                <div class="game-statistic-result">0</div>
                <div class="game-statistic-title">Game Visits</div>
            </div>
            <div class="cell small-6 medium-3 game-statistic">
                <div class="game-statistic-result">0</div>
                <div class="game-statistic-title">Favorited</div>
            </div>
            <div class="cell small-6 medium-3 game-statistic">
                <div class="game-statistic-result">{{ $game->created_at->format('M d, Y') }}</div>
                <div class="game-statistic-title">Date Created</div>
            </div>
            <div class="cell small-6 medium-3 game-statistic">
                <div class="game-statistic-result">{{ $game->updated_at->format('M d, Y') }}</div>
                <div class="game-statistic-title">Last Updated</div>
            </div>
        </div>
    </div>
    <div class="game-description-header">Description</div>
    <div class="game-description container">{{ !empty($game->description) ? nl2br(e($game->description)) : 'This game has no description.' }}</div>
    {{-- <div class="game-description-header">Servers</div>
    <div class="container">
        @forelse ($game->servers() as $server)
            okokok
        @empty
            <p>This game has no active servers.</p>
        @endforelse
    </div> --}}
@endsection
