

@extends('master', [
    'pageTitle' => 'Achievements',
    'bodyClass' => 'achievements-page'
])

@section('content')
    <h5 class="mb-25">Special Achievements</h5>
    <div class="grid-x grid-margin-x">
        @foreach ($special as $achievement)
            @include('achievements._achievement', ['achievement' => $achievement])
        @endforeach
    </div>
    <h5 class="mb-25">Membership Achievements</h5>
    <div class="grid-x grid-margin-x">
        @foreach ($membership as $achievement)
            @include('achievements._achievement', ['achievement' => $achievement])
        @endforeach
    </div>
    <h5 class="mb-25">General Achievements</h5>
    <div class="grid-x grid-margin-x">
        @foreach ($general as $achievement)
            @include('achievements._achievement', ['achievement' => $achievement])
        @endforeach
    </div>
@endsection
