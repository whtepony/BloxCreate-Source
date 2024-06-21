

@extends('master', [
    'pageTitle' => 'Login',
    'bodyClass' => 'auth-page'
])

@section('content')
    <div class="grid-x">
        <div class="cell medium-6 medium-offset-4">
            <div class="container auth-container">
                <h5 class="mb-25">Log in</h5>
                <form action="{{ route('login.authenticate') }}" method="POST">
                    {{ csrf_field() }}
                    <input class="form-input" type="text" name="username" placeholder="Username" value="{{ old('username') }}" required>
                    <input class="form-input" type="password" name="password" placeholder="Password" required>
                    <div class="grid-x align-middle">
                        <div class="cell auto">
                            <button class="button button-blue" type="submit">Log in</button>
                        </div>
                        <div class="cell shrink">
                            <a href="/forgot-password">Forgot password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
