

@extends('master', [
    'pageTitle' => 'Thank you for your Report',
    'bodyClass' => 'report-page',
    'blank' => true
])

@section('additional_meta')
    <meta http-equiv="refresh" content="1;url=/">
@endsection

@section('content')
    <div class="push-50"></div>
    <p>Thank you for reporting this content! Our moderators will look into this report and determine the best course of action. Redirecting...</p>
@endsection
