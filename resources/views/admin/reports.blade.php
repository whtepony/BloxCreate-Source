

@extends('admin', [
    'pageTitle' => 'Reports'
])

@section('header')
    <section class="content-header">
        <h1>
            Reports
            <small>({{ $total }} total)</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Reports</li>
        </ol>
    </section>
@endsection

@section('content')
<div class="row">
    @forelse ($reports as $report)
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <ul>
                        <li><strong>Reported By:</strong> {{ $report->creator->username }} <a href="{{ route('admin.users', ['search' => $report->creator->username]) }}">[Click to view]</a></li>
                        <li><strong>Type:</strong> {{ $report->type() }} <a href="{{ $report->url() }}" target="_blank">[Click to view]</a></li>
                        <li><strong>Reason:</strong> {{ $report->reason() }}</li>
                        <li><strong>Comment:</strong> <div style="white-space:pre-wrap;word-break:break-word;">{{ $report->comment ?? 'No comment provided.' }}</div></li>
                    </ul>
                    <form action="{{ route('admin.reports.update') }}" method="POST" style="display:inline-block;">
                        {{ csrf_field() }}
                        <input type="hidden" name="report_id" value="{{ $report->id }}">
                        <input type="hidden" name="action" value="seen">
                        <button class="btn btn-fluid btn-success" type="submit">Mark Report as Seen & Dealt With</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-xs-12">There are currently no pending reports.</div>
    @endforelse
</div>
@endsection
