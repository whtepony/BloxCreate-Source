

@extends('master', [
    'pageTitle' => 'Beta Program',
    'bodyClass' => 'discord-page',
    'gridClass' => 'discord-grid'
])

@section('content')
    <h5>Beta</h5>
    <div class="container">
        <div class="text-center">
            @if (!Auth::user()->beta_tester)
                <i class="icon icon-discord"></i>
                <div class="discord-title">Join the Beta Program</div>
                <p>Click the 'Join' button below to join the beta program.</p>
                <form action="{{ route('beta.update') }}" method="POST">
                    {{ csrf_field() }}
                    <button class="button button-block button-green">Join</button>
                </form>
            @else
                <i class="icon icon-discord has-verified"></i>
                <div class="discord-title">Leave the Beta Program</div>
                <p>Click the 'Leave' button below to leave the beta program.</p>
                <form action="{{ route('beta.update') }}" method="POST">
                    {{ csrf_field() }}
                    <button class="button button-block button-red">Leave</button>
                </form>
            @endif
        </div>
    </div>
@endsection
