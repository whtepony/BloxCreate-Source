

<div class="grid-x grid-margin-x align-middle forum-post-grid @if ($thread->deleted) is-deleted @endif">
    <div class="cell medium-8">
        <div class="forum-post-creator-avatar">
            <img class="forum-post-creator-avatar-image" src="{{ $thread->creator->headshot() }}">
        </div>
        <div class="forum-post-details">
            <a href="{{ route('forum.thread', ['id' => $thread->id]) }}" class="forum-post-name @if ($thread->pinned) forum-post-name-pinned @endif">{{ $thread->title }}</a>
            <div class="forum-post-poster">posted by <a href="{{ route('users.profile', ['id' => $thread->creator->id, 'username' => $thread->creator->username]) }}">{{ $thread->creator->username }}</a> {{ $thread->created_at->diffForHumans() }}</div>
        </div>
    </div>
    <div class="cell medium-1 text-center hide-for-small-only">
        <div class="forum-container-stat">{{ number_format($thread->replies()->count()) }}</div>
    </div>
    <div class="cell medium-1 text-center hide-for-small-only">
        <div class="forum-container-stat">{{ number_format($thread->views) }}</div>
    </div>
    <div class="cell medium-2 text-right hide-for-small-only">
        @if (empty($thread->last_poster_id))
            N/A
        @else
            <a href="{{ route('forum.thread', ['id' => $thread->id]) }}" class="forum-container-stat forum-container-stat-last-post">{{ $thread->title }}</a>
            <div class="forum-container-stat forum-container-stat-last-poster">
                @if (empty($thread->last_reply_id))
                    by <a href="{{ route('users.profile', ['id' => $thread->creator->id, 'username' => $thread->creator->username]) }}">{{ $thread->creator->username }}</a>, {{ $thread->created_at->diffForHumans() }}
                @else
                    by <a href="{{ route('users.profile', ['id' => $thread->lastPoster->id, 'username' => $thread->lastPoster->username]) }}">{{ $thread->lastPoster->username }}</a>, {{ $thread->lastReply->created_at->diffForHumans() }}
                @endif
            </div>
        @endif
    </div>
</div>
