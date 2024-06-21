

@extends('master', [
    'pageTitle' => 'Forgot Password',
    'bodyClass' => 'auth-page'
])

@section('content')
    <div class="grid-x">
        <div class="cell medium-6 medium-offset-4">
            <div class="container auth-container">
                <h5><i class="icon icon-success"></i> Email Sent</h5>
                <p class="mb-25">Check your email within the next two minutes for instructions on how to reset your password.</p>
                <div class="forgot-password-text">We will attempt to send an email to the email we have on file with your account. If you do not have access to the email, please email us at {!! mailto('support') !!}</div>
            </div>
        </div>
    </div>
@endsection
