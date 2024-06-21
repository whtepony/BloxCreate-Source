

@extends('master', [
    'pageTitle' => $title,
    'bodyClass' => 'notes-page',
    'gridFluid' => true
])

@section('content')
    <div class="grid-x grid-margin-x">
        <div class="cell medium-3">
            <h5>Notes</h5>
            <div class="container notes-sidebar">
                <a href="{{ route('notes', ['page' => 'terms']) }}" class="notes-sidebar-item @if ($active == 'terms') active @endif">Terms of Service</a>
                <a href="{{ route('notes', ['page' => 'privacy']) }}" class="notes-sidebar-item @if ($active == 'privacy') active @endif">Privacy Policy</a>
                <a href="{{ route('notes', ['page' => 'about']) }}" class="notes-sidebar-item @if ($active == 'about') active @endif">About</a>
                <a href="{{ route('notes', ['page' => 'jobs']) }}" class="notes-sidebar-item @if ($active == 'jobs') active @endif">Jobs</a>
                <a href="{{ route('notes', ['page' => 'team']) }}" class="notes-sidebar-item @if ($active == 'team') active @endif">Team</a>
                <a href="{{ route('notes', ['page' => 'contact']) }}" class="notes-sidebar-item @if ($active == 'contact') active @endif">Contact</a>
				<a href="{{ route('notes', ['page' => 'roadmap']) }}" class="notes-sidebar-item @if ($active == 'roadmap') active @endif">Roadmap</a>
            </div>
            <div class="push-25 show-for-small-only"></div>
        </div>
        <div class="cell medium-9">
            <h5>{{ $title }}</h5>
            <div class="container">
                @include($file)
            </div>
        </div>
    </div>
@endsection
