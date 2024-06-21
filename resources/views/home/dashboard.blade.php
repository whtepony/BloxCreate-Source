

@extends('master', [
    'pageTitle' => 'Dashboard',
    'bodyClass' => 'dashboard-page'
])

@section('content')
    <div class="grid-x grid-margin-x">
        <div class="cell medium-3">
            <div class="container dashboard-avatar-container mb-25">
                <img class="dashboard-avatar" src="{{ Auth::user()->thumbnail() }}">
            </div>
            <div class="dashboard-header">Blog</div>
            <div class="container dashboard-blog-container">
                @forelse ($blogPosts['posts'] as $blogPost)
                    <div class="dashboard-blog-post">
                        <a href="{{ $blogPost['url'] }}" class="blog-post-title" target="_blank">{{ $blogPost['title'] }}</a>
                        <div class="blog-post-body">{{ Str::limit($blogPost['excerpt'], 25, '...') }}</div>
                    </div>
                @empty
                    <p>No updates found.</p>
                @endforelse
            </div>
            <div class="push-25 show-for-small-only"></div>
        </div>
        <div class="cell medium-9">
            <div class="container mb-25">
                <form action="{{ route('status') }}" method="POST">
                    {{ csrf_field() }}
                    <input class="form-input" type="text" name="content" placeholder="What's up?" value="{{ Auth::user()->status() }}">
                </form>
            </div>
            <div class="dashboard-header">Feed</div>
            <div class="container dashboard-feed-container">
                @forelse ($statuses as $status)
                    <div class="dashboard-status">
                        <div class="grid-x grid-margin-x">
                            <div class="cell small-3 medium-2 text-center">
                                <div class="dashboard-status-creator-avatar">
                                    <a href="{{ route('users.profile', ['id' => $status->creator->id, 'username' => $status->creator->username]) }}">
                                        <img class="dashboard-status-creator-avatar-image" src="{{ $status->creator->headshot() }}">
                                    </a>
                                </div>
                                <a href="{{ route('users.profile', ['id' => $status->creator->id, 'username' => $status->creator->username]) }}" class="dashboard-status-creator">{{ $status->creator->username }}</a>
                            </div>
                            <div class="cell small-9 medium-10">
                                <div class="dashboard-status-content">{{ $status->content }}</div>
                                <div class="dashboard-status-time"><i class="icon icon-time-ago"></i> {{ $status->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="feed-no-notifications">You have no notifications.</div>
                    <div class="feed-why-not">Why not try <a href="{{ route('users.index') }}">searching for users</a> or <a href="{{ route('forum.index') }}">chatting with users</a> in our forum?</div>
                @endforelse
            </div>
            <div class="push-10"></div>
        </div>
    </div>
@endsection
