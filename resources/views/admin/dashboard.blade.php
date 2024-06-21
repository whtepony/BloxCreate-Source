

@extends('admin', [
    'pageTitle' => 'Dashboard'
])

@section('header')
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control Panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-4 col-md-3">
                            <img class="img-responsive" src="{{ Auth::user()->thumbnail() }}">
                        </div>
                        <div class="col-xs-8 col-md-9">
                            <h4 class="font-weight-bold">Hello, {{ Auth::user()->username }}!</h4>
                            <p><strong>Your Rank:</strong> {{ Auth::user()->adminRank() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Recent Actions</h3>
                </div>
                <div class="box-body">
                    <ul class="list-unstyled recent-actions">
                        <li>
                            <i class="fas fa-plus-circle text-success"></i>
                            <a href="#">Isaiah</a> created item <a href="#">test hat</a>.
                        </li>
                        <li>
                            <i class="fas fa-pencil text-orange"></i>
                            <a href="#">Isaiah</a> edited item <a href="#">test hat</a>.
                        </li>
                        <li>
                            <i class="fas fa-times-circle text-danger"></i>
                            <a href="#">Isaiah</a> deleted item <a href="#">test hat</a>.
                        </li>
                    </ul>
                    <p class="text-muted"><small>* This is dummy data</small></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="info-box">
                <span class="info-box-icon bg-yellow">
                    <i class="fal fa-users"></i>
                </span>
                <div class="info-box-content">
                    <div class="info-box-text">Total Members</div>
                    <div class="info-box-number">{{ number_format($totalMembers) }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="info-box">
                <span class="info-box-icon bg-green">
                    <i class="fal fa-signal"></i>
                </span>
                <div class="info-box-content">
                    <div class="info-box-text">Users Online Now</div>
                    <div class="info-box-number">{{ number_format($usersOnlineNow) }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="info-box">
                <span class="info-box-icon bg-light">
                    <i class="fal fa-clock"></i>
                </span>
                <div class="info-box-content">
                    <div class="info-box-text">Registered Today</div>
                    <div class="info-box-number">{{ number_format($registeredToday) }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="info-box">
                <span class="info-box-icon bg-red">
                    <i class="fal fa-user-friends"></i>
                </span>
                <div class="info-box-content">
                    <div class="info-box-text">Admins Online Now</div>
                    <div class="info-box-number">{{ number_format($adminsOnlineNow) }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="info-box">
                <span class="info-box-icon bg-red">
                    <i class="fal fa-user-friends"></i>
                </span>
                <div class="info-box-content">
                    <div class="info-box-text">Total Admins</div>
                    <div class="info-box-number">{{ number_format($totalAdmins) }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="info-box">
                <span class="info-box-icon bg-blue">
                    <i class="fal fa-hat-cowboy"></i>
                </span>
                <div class="info-box-content">
                    <div class="info-box-text">Total Items</div>
                    <div class="info-box-number">{{ number_format($totalItems) }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="info-box">
                <span class="info-box-icon bg-purple">
                    <i class="fal fa-group"></i>
                </span>
                <div class="info-box-content">
                    <div class="info-box-text">Total Groups</div>
                    <div class="info-box-number">{{ number_format($totalGroups) }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
