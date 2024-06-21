

@extends('master', [
    'pageTitle' => 'Banned',
    'bodyClass' => 'ban-page',
    'gridClass' => 'ban-grid'
])

@section('additional_js')
    <script>
        $(function() {
            $('#acceptTos').on('change', function() {
                if (this.checked) {
                    $('#reactivateButton').attr('disabled', false);
                } else {
                    $('#reactivateButton').attr('disabled', true);
                }
            });
        });
    </script>
@endsection

@section('content')
    <div class="container">
        <h5 style="font-weight:500;">{{ ($ban->length != 'warning' && $ban->length != 'closed') ? 'Banned for ' : '' }}{{ $ban->length() }}</h5>
        <p>Your account was suspended for violating our <a href="{{ route('notes', ['page' => 'terms']) }}">terms of service</a>.</p>
        <p>You will need to change your behaviour in order to continue playing on <a href="/">BLOX-City.com</a>. Repeated violations of our terms of service will result in <strong>permanent</strong> suspension.</p>
        <p>Below is information associated with this suspension. If you have any questions, concerns, or comments related to this suspension, we advise that you contact our appeals depertment via email at {!! mailto('moderation') !!}.</p>
        <hr>
        <div class="info">
            <div class="info-name">Reviewed:</div>
            <div class="info-result">{{ $ban->created_at->format('M d, Y h:i A') }}</div>
        </div>
        <div class="info">
            <div class="info-name">Reason:</div>
            <div class="info-result">{{ $ban->category() }}</div>
        </div>
        @if (!empty($ban->note))
            <div class="info">
                <div class="info-name">Mod Note:</div>
                <div class="info-result">{{ $ban->note }}</div>
            </div>
        @endif
        <div class="push-15"></div>
        <div class="text-center">
            @if ($ban->length == 'closed')
                <p>Your account has been closed. Thank you for playing!</p>
            @else
                @if (strtotime($ban->banned_until) < time())
                    <form action="{{ route('account.banned.update') }}" method="POST">
                        {{ csrf_field() }}
                        <input class="form-checkbox" id="acceptTos" type="checkbox" name="accept_tos">
                        <label class="form-label" for="accept_tos">I have read and agree to follow the <a href="/notes/terms">terms of service</a>.</label>
                        <div class="push-15"></div>
                        <button class="button button-blue" id="reactivateButton" type="submit" disabled>Reactivate Account</button>
                    </form>
                    <div class="push-15"></div>
                @endif
            @endif
            <a href="{{ route('logout') }}" class="button button-red">Logout</a>
        </div>
    </div>
@endsection
