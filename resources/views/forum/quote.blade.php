

@extends('master', [
    'pageTitle' => 'Reply to "'. $reply->thread->title .'"',
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
                    <a href="{{ route('forum.topic', ['id' => $reply->thread->topic->id]) }}">{{ $reply->thread->topic->name }}</a>
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
        Reply to in "{{ $reply->thread->title }}"
    </div>
    <div class="container forum-container">
        <div class="forum-quote">
            @if ($reply->creator->power < 4)
                <div class="forum-quote-body">{!! nl2br(e($reply->body)) !!}</div>
            @else
                <div class="forum-quote-body">{!! nl2br($reply->body) !!}</div>
            @endif
            <div class="forum-quote-footer"><a href="{{ route('users.profile', ['id' => $post->creator->id, 'username' => $reply->creator->username]) }}">{{ $reply->creator->username }}</a>, {{ $reply->created_at->format('m-d Y h:i A') }}</div>
        </div>
        <form action="{{ route('forum.quote.store') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="reply_id" value="{{ $reply->id }}">
            <textarea class="form-input" name="body" placeholder="Write your post here." rows="5"></textarea>
            <button class="forum-button" type="submit">Post</button>
        </form>
    </div>
@endsection
