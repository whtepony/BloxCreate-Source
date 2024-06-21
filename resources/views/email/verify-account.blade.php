

@extends('email._layout', [
    'title' => 'Verify Your Email'
])

@section('content')
    <p>Hi there {{ $user->username }}! Someone (hopefully you!) has created a {{ config('app.name') }} account with your email.</p>
    <p>To verify simply click the URL below to verify your account.</p>
    <p><a href="{{ route('account.verify.confirm', ['code' => $code]) }}">{{ route('account.verify.confirm', ['code' => $code]) }}</a></p>
    <p>If you didn't request this email, please ignore it.</p>
@endsection
