

@extends('master', [
    'pageTitle' => 'Reply to "'. $thread->title .'"',
    'bodyClass' => 'forum-page',
    'gridClass' => 'forum-grid'
])

@section('content')
    <div class="show-for-small-only text-center">
        <a href="{{ route('forum.my-threads') }}" class="button button-blue">My Threads</a>
        <a href="{{ route('forum.search') }}" class="button button-red">Search Forum</a>
    </div>
    <div class="grid-x grid-margin-x">
        <div class="cell small-9 medium-6">
            <div class="forum-navigation">
                <div class="forum-navigation-item">
                    <a href="{{ route('forum.index') }}">Forum</a>
                </div>
                <div class="forum-navigation-item">
                    <a href="{{ route('forum.index') }}">{{ config('app.name') }}</a>
                </div>
                <div class="forum-navigation-item">
                    <a href="{{ route('forum.topic', ['id' => $thread->topic->id]) }}">{{ $thread->topic->name }}</a>
                </div>
            </div>
        </div>
        <div class="cell medium-6 text-right hide-for-small-only">
            <div class="forum-auth-navigation">
                <div class="forum-auth-navigation-item">
                    <a href="{{ route('forum.my-threads') }}">My Threads</a>
                </div>
                <div class="forum-auth-navigation-item">
                    <a href="{{ route('forum.search') }}">Search Forum</a>
                </div>
            </div>
        </div>
    </div>
    <div class="forum-header forum-thread-header">
        Reply to in "{{ $thread->title }}"
    </div>
    <div class="container forum-container">
        <form action="{{ route('forum.reply.store') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="thread_id" value="{{ $thread->id }}">
            <textarea class="form-input" name="body" placeholder="Write your post here." rows="5"></textarea>
            <button class="forum-button" type="submit">Post</button>
        </form>
    </div>
@endsection
