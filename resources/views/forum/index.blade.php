@extends('master', [
    'pageTitle' => 'Forum',
    'bodyClass' => 'forum-page',
    'gridClass' => 'forum-grid'
])

@section('content')
    @if (!settings('forum_enabled'))
        <div class="container construction-container">
            <i class="icon icon-sad construction-icon"></i>
            <div class="construction-text">Sorry, the Forum is unavailable right now for maintenance. Try again later.</div>
        </div>
    @else
        @foreach ($sections as $section)
            <div class="forum-header">
                <div class="grid-x grid-margin-x">
                    <div class="cell medium-8">
                        {{ $section['header'] }}
                    </div>
                    <div class="cell medium-1 text-center hide-for-small-only">
                        Threads
                    </div>
                    <div class="cell medium-1 text-center hide-for-small-only">
                        Replies
                    </div>
                    <div class="cell medium-2 text-right hide-for-small-only">
                        Last Post
                    </div>
                </div>
            </div>
            @forelse ($topics->whereIn('id', $section['topic_ids']) as $topic)
                <div class="forum-container">
                    <div class="grid-x grid-margin-x align-middle">
                        <div class="cell medium-8">
                            <a href="{{ route('forum.topic', ['id' => $topic->id]) }}">
                                <div class="forum-container-topic-name">{{ $topic->name }}</div>
                                <div class="forum-container-topic-description">{{ $topic->description }}</div>
                            </a>
                        </div>
                        <div class="cell medium-1 text-center hide-for-small-only">
                            <div class="forum-container-stat">{{ number_format($topic->threads()->count()) }}</div>
                        </div>
                        <div class="cell medium-1 text-center hide-for-small-only">
                            <div class="forum-container-stat">0</div>
                        </div>
                        <div class="cell medium-2 text-right hide-for-small-only">
                            @if (empty($topic->last_thread_id))
                                N/A
                            @else
                                <a href="{{ route('forum.thread', ['id' => $topic->lastThread->id]) }}" class="forum-container-stat forum-container-stat-last-post">{{ $topic->lastThread->title }}</a>
                                <div class="forum-container-stat forum-container-stat-last-poster">
                                    by <a href="{{ route('users.profile', ['id' => $topic->lastPoster->id, 'username' => $topic->lastPoster->username]) }}">{{ $topic->lastPoster->username }}</a>, {{ $topic->last_post_at->diffForHumans() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="forum-container">
                    Nothing here...
                </div>
            @endforelse
            <div style="margin-bottom: 20px;"></div>
        @endforeach
    @endif
@endsection