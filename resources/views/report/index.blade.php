

@extends('master', [
    'pageTitle' => $title,
    'bodyClass' => 'report-page',
    'gridClass' => 'report-grid',
    'blank' => true
])

@section('content')
    <div class="push-50"></div>
    <h5>{{ $title }}</h5>
    <div class="container">
        <form action="{{ route('report.store') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="type" value="{{ $type }}">
            <input type="hidden" name="id" value="{{ $content->id }}">
            <strong>How is this content breaking the {{ config('app.name') }} rules?</strong>
            <select class="form-input" name="reason">
                <option value="spam" selected>This content is spam</option>
                <option value="profanity">This content contains bad words</option>
                <option value="sensitive_topics">This content discusses sensitive topics</option>
                <option value="offsite_links">This content contains offsite links</option>
                <option value="harassment">This content harasses me or someone else</option>
                <option value="discrimination">This content contains discrimination</option>
                <option value="sexual_content">This content contains sexual content</option>
                <option value="inappropriate_content">This content contains inappropriate content</option>
                <option value="false_information">This content is spreading false information</option>
                <option value="other">Other</option>
            </select>
            <strong>Leave a comment (optional)</strong>
            <textarea class="form-input" name="comment" placeholder="This person is breaking the rules by..." rows="5"></textarea>
            <strong>Content:</strong>
            <div class="report-content">
                @if ($type == 'user')
                    <strong>Username:</strong>
                    <div class="mb-10">{{ $content->username }}</div>
                    <strong>Description:</strong>
                    @if (empty($content->description))
                        <div class="report-content-body">This user has no description.</div>
                    @else
                        @if ($content->power < 4)
                            <div class="report-content-body">{!! nl2br(e($content->description)) !!}</div>
                        @else
                            <div class="report-content-body">{!! nl2br($content->description) !!}</div>
                        @endif
                    @endif
                    <strong>Avatar:</strong>
                    <img class="report-content-image" src="{{ $content->thumbnail() }}">
                @elseif ($type == 'item')
                    <strong>Name:</strong>
                    <div class="mb-10">{{ $content->name }}</div>
                    <strong>Description:</strong>
                    @if (empty($content->description))
                        <div class="report-content-body">This user has no description.</div>
                    @else
                        <div class="report-content-body mb-10">{!! nl2br(e($content->description)) !!}</div>
                    @endif
                    <strong>Preview:</strong>
                    <img class="report-content-image" src="{{ $content->thumbnail() }}">
                @elseif ($type == 'forum-thread')
                    <strong>Title:</strong>
                    <div class="mb-10">{{ $content->title }}</div>
                    <strong>Post:</strong>
                    @if ($content->creator->power < 4)
                        <div class="report-content-body">{!! nl2br(e($content->body)) !!}</div>
                    @else
                        <div class="report-content-body">{!! nl2br($content->body) !!}</div>
                    @endif
                @elseif ($type == 'forum-reply')
                    <strong>Post:</strong>
                    @if ($content->creator->power < 4)
                        <div class="report-content-body">{!! nl2br(e($content->body)) !!}</div>
                    @else
                        <div class="report-content-body">{!! nl2br($content->body) !!}</div>
                    @endif
                @elseif ($type == 'item-comment')
                    <strong>Comment:</strong>
                    <div class="report-content-body">{{ $content->body }}</div>
                @endif
            </div>
            <button class="button button-blue" type="submit">Send Report</button>
        </form>
    </div>
@endsection
