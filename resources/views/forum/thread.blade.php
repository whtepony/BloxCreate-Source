

@extends('master', [
    'pageTitle' => $thread->title,
    'pageDescription' => $thread->title . ' is a forum post on ' . config('app.name') . ' by ' . $thread->creator->username . '. Join them in creating awesome friendships, items, games, and more!',
    'pageImage' => $thread->creator->headshot(),
    'bodyClass' => 'forum-page',
    'gridClass' => 'forum-grid'
])

@section('content')
    @if ($thread->deleted)
        <div class="alert alert-error">
            <div class="grid-x grid-margin-x align-middle">
                <div class="cell shrink left">
                    <i class="icon icon-error"></i>
                </div>
                <div class="cell auto text-center">
                    This thread is deleted.
                    &nbsp;&nbsp;
                    <a href="{{ route('forum.moderate', ['type' => 'thread', 'id' => $thread->id, 'action' => 'switch_delete']) }}" class="button button-green" style="font-size:11px;">Undelete</a>
                </div>
                <div class="cell shrink right">
                    <i class="icon icon-error"></i>
                </div>
            </div>
        </div>
    @endif
    @auth
        <div class="show-for-small-only text-center">
            <a href="{{ route('forum.my-threads') }}" class="button button-blue">My Threads</a>
            <a href="{{ route('forum.search') }}" class="button button-red">Search Forum</a>
        </div>
    @endauth
    <div class="grid-x grid-margin-x">
        <div class="cell small-12 medium-6">
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
        @auth
            <div class="cell small-12 medium-6 text-right hide-for-small-only">
                <div class="forum-auth-navigation">
                    <div class="forum-auth-navigation-item">
                        <a href="{{ route('forum.my-threads') }}">My Threads</a>
                    </div>
                    <div class="forum-auth-navigation-item">
                        <a href="{{ route('forum.search') }}">Search Forum</a>
                    </div>
                </div>
            </div>
        @endauth
    </div>
    <div class="forum-header forum-thread-header">
        {{ $thread->title }}
    </div>
    <div class="container">
        @if ($replies->onFirstPage())
            @include('forum._reply', ['post' => $thread, 'isThread' => true])
        @endif
        @foreach ($replies as $reply)
            @include('forum._reply', ['post' => $reply, 'isThread' => false])
        @endforeach
        {{ $replies->onEachSide(1)->links('pagination.default') }}
    </div>
    @auth
        @if (!$thread->locked || ($thread->locked && Auth::user()->power > 1))
            <div class="push-15"></div>
            <div class="text-center">
                <a href="{{ route('forum.reply', ['id' => $thread->id]) }}" class="forum-button">Reply</a>
            </div>
        @endif
    @endauth
@endsection
