

@extends('master', [
    'pageTitle' => 'Forgot Password',
    'bodyClass' => 'auth-page'
])

@section('content')
    <div class="grid-x">
        <div class="cell medium-6 medium-offset-4">
            <div class="container auth-container">
                <h5 class="mb-25">Forgot your password?</h5>
                <form class="mb-25" method="POST">
                    <input class="form-input" type="text" name="username" placeholder="Enter your username">
                    <button class="button button-blue" type="submit">Send email</button>
                </form>
                <div class="forgot-password-text">We will attempt to send an email to the email we have on file with your account. If you do not have access to the email, please email us at {!! mailto('support') !!}</div>
            </div>
        </div>
    </div>
@endsection
