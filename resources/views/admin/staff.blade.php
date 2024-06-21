

@extends('admin', [
    'pageTitle' => 'Staff'
])

@section('header')
    <section class="content-header">
        <h1>
            Staff
            <small>({{ $total }} total)</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Staff</li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="row">
        @forelse ($staff as $user)
            <div class="col-xs-6 col-md-6 col-lg-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title text-primary">{{ $user->username }}</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <img src="{{ $user->thumbnail() }}" class="img-responsive">
                                <br>
                                <a href="{{ route('admin.users', ['search' => $user->username]) }}" class="btn btn-sm btn-fluid btn-primary">View</a>
                                <a href="{{ route('admin.manage_staff', ['search' => $user->username]) }}" class="btn btn-sm btn-fluid btn-success btn-manage @if ($user->power >= Auth::user()->power && Auth::user()->id != 1 || $user->id == 1) disabled @endif">Change Rank</a>
                            </div>
                            <div class="col-md-6 text-center">
                                <h3>{{ $user->id }}</h3>
                                <h5><strong>User ID</strong></h5>
                                <h3>{{ $user->adminRank() }}</h3>
                                <h5><strong>Admin Level</strong></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-body">
                        <p>There are currently no staff members.</p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
@endsection
