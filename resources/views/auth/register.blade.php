

@extends('master', [
    'pageTitle' => 'Register',
    'bodyClass' => 'auth-page'
])

@section('content')
<script src="//www.google.com/recaptcha/api.js"></script>
    <div class="grid-x">
        <div class="cell medium-6 medium-offset-4">
            <div class="container auth-container">
                <h5 class="mb-25">Register</h5>
                @if (!settings('registration_enabled'))
                    <style>h5.mb-25 { margin-bottom: 10px; }</style>
                    <p>We're sorry, account creation is currently disabled. Please try again later.</p>
                @else
                    <form action="{{ route('register.authenticate') }}" method="POST">
                        {{ csrf_field() }}
                        <input class="form-input" type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
                        <input class="form-input" type="text" name="username" placeholder="Username" value="{{ old('username') }}" required>
                        <input class="form-input" type="password" name="password" placeholder="Password" required>
                        <input class="form-input" type="password" name="password_confirmation" placeholder="Password (again)" required>
                        <input class="form-checkbox" type="checkbox" name="accept_tos">
                        <label class="form-label" for="accept_tos">I agree to follow the <a href="{{ route('notes', ['page' => 'terms']) }}">terms of service</a></label>
						<div class="push-15"></div>
						@if (config('app.env') == 'production')
                                <div class="mt-3 mb-3">
                                    {!! NoCaptcha::display(['data-theme' => 'light']) !!}
                                </div>
                            @endif
                        <div class="push-15"></div>
                        <button class="button button-blue" type="submit">Register</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
