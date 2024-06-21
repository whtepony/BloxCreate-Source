

@extends('master', [
    'pageTitle' => 'Verify',
    'bodyClass' => 'verify-page',
    'gridClass' => 'verify-grid'
])

@section('additional_css')
    <style>
        .verify-page .verify-grid {
            max-width: 800px;
        }

        .verify-page .verify-icon {
            font-size: 100px;
            margin-bottom: 15px;
        }

        .verify-page p {
            font-weight: 500
        }

        .verify-page .verify-button {
            min-width: 100px;
        }
    </style>
@endsection

@section('content')
    <div class="container text-center">
        @if (empty(Auth::user()->email_verified_at))
            @if ($emailSent)
                <i class="verify-icon fas fa-check-circle" style="color:green;"></i>
                <p>An email has been sent to your inbox. You can re-try again after 5 minutes.</p>
                <p>Be sure to check your spam folder if you can't find the email.</p>
            @else
                <i class="verify-icon fas fa-times-circle" style="color:red;"></i>
                <p>You are not verified! Click the "Verify" button below to send an email to your account!</p>
                <form action="{{ route('account.verify.send') }}" method="POST">
                    {{ csrf_field() }}
                    <button class="verify-button button button-green" type="submit">Verify</button>
                </form>
            @endif
        @else
            <i class="verify-icon fas fa-check-circle" style="color:green;"></i>
            <p>Your account has been verified.</p>
        @endif
    </div>
@endsection
