@extends('master', [
    'pageTitle' => 'Error',
    'pageDescription' => $errorDesc,
    'bodyClass' => 'error-page',
    'gridClass' => 'error-grid',
    'blank' => true
])

@section('additional_fonts')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Asap:400,700">
@endsection

@section('additional_js')
    <script>
        $(function() {
            if (window.document.referrer == '') {
                $('#backButton').addClass('disabled').attr('title', 'You can not go back!');
            } else {
                $('#backButton').click(function() {
                    window.history.back();
                });
            }
        });
    </script>
@endsection

@section('content')
    <div class="error-container">
        <div class="grid-x grid-margin-x">
            <div class="cell medium-5 hide-for-small-only">
                <img class="error-image" src="{{ storage('web-img/error.png') }}">
            </div>
            <div class="cell medium-7">
                <div class="error-title"><h1>{{ $errorTitle }}</h1></div>
                <div class="error-description">{{ $errorDesc }}</div>
                <div class="error-contact">If you continue to encounter this error, please contact <a href="/notes/contact">customer support</a>.</div>
                <div class="error-buttons">
                    <button class="button button-blue" id="backButton">Previous Page</button>
                    <a href="{{ (Auth::check()) ? route('dashboard') : route('landing') }}" class="button button-blue">Back to the Building Site!</a>
                </div>
                <div class="error-code"><strong>Error Code:</strong> 57ZUQ6KMVUX4QDWLDIZC</div>
            </div>
        </div>
    </div>
@endsection
