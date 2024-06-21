

@php
    use Carbon\Carbon;
@endphp

@extends('admin', [
    'pageTitle' => 'Groups'
])

@section('header')
    <section class="content-header">
        <h1>
            Groups
            <small>(0 total)</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Groups</li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Search for group</h3>
        </div>
        <div class="box-body">
            <form method="GET">
                <div class="input-group">
                    <input class="form-control" type="number" name="id" placeholder="ID">
                    <span class="input-group-btn">
                        <button class="btn btn-flat btn-primary" type="submit">Search</button>
                    </span>
                </div>
            </form>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title text-primary">Namesnipe</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-2 col-lg-2 text-center">
                    <img src="{{ storage('img/groups/namesnipe.png') }}" class="img-responsive">
                    <br>
                    <a href="#" class="btn btn-fluid btn-primary" target="_blank">View</a>
                </div>
                <div class="col-md-6 col-lg-3">
                    <ul>
                        <li><strong>Group ID:</strong> 1</li>
                        <li><strong>Owner:</strong> Sesuiro <a href="#">[Click to view]</a></li>
                        <li><strong>Is Disabled:</strong> No</li>
                        <li><strong>Is Verified:</strong> No</li>
                        <li><strong>Creation Date:</strong> {{ Carbon::now() }}</li>
                        <li><strong>Last Updated:</strong> {{ Carbon::now() }}</li>
                        <li><strong># Members:</strong> 1</li>
                        <li><strong># Ranks:</strong> 1</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
