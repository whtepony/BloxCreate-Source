

@extends('admin', [
    'pageTitle' => 'Site Settings'
])

@section('header')
    <section class="content-header">
        <h1>
            Site Settings
            <small>Manage Features</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Site Settings</li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-lg-2">
                    <h4>Maintenance Enabled</h4>
                    <form action="{{ route('admin.site_settings.update') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="setting" value="maintenance">
                        <select class="form-control" name="enabled" required>
                            <option value="1" @if (settings('maintenance_enabled')) selected @endif>Yes</option>
                            <option value="0" @if (!settings('maintenance_enabled')) selected @endif>No</option>
                        </select>
                        <button class="btn btn-success" type="submit">Update</button>
                    </form>
                </div>
                <div class="col-md-4 col-lg-2">
                    <h4>Alert Enabled</h4>
                    <form action="{{ route('admin.site_settings.update') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="setting" value="alert">
                        <select class="form-control" name="enabled" required>
                            <option value="1" @if (settings('alert_enabled')) selected @endif>Yes</option>
                            <option value="0" @if (!settings('alert_enabled')) selected @endif>No</option>
                        </select>
                        <button class="btn btn-success" type="submit">Update</button>
                    </form>
                </div>
                <div class="col-md-4 col-lg-2">
                    <h4>Upgrades Enabled</h4>
                    <form action="{{ route('admin.site_settings.update') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="setting" value="upgrades">
                        <select class="form-control" name="enabled" required>
                            <option value="1" @if (settings('upgrades_enabled')) selected @endif>Yes</option>
                            <option value="0" @if (!settings('upgrades_enabled')) selected @endif>No</option>
                        </select>
                        <button class="btn btn-success" type="submit">Update</button>
                    </form>
                </div>
                <div class="col-md-4 col-lg-2">
                    <h4>Market Purchases Enabled</h4>
                    <form action="{{ route('admin.site_settings.update') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="setting" value="market_purchases">
                        <select class="form-control" name="enabled" required>
                            <option value="1" @if (settings('market_purchases_enabled')) selected @endif>Yes</option>
                            <option value="0" @if (!settings('market_purchases_enabled')) selected @endif>No</option>
                        </select>
                        <button class="btn btn-success" type="submit">Update</button>
                    </form>
                </div>
                <div class="col-md-4 col-lg-2">
                    <h4>Forum Enabled</h4>
                    <form action="{{ route('admin.site_settings.update') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="setting" value="forum">
                        <select class="form-control" name="enabled" required>
                            <option value="1" @if (settings('forum_enabled')) selected @endif>Yes</option>
                            <option value="0" @if (!settings('forum_enabled')) selected @endif>No</option>
                        </select>
                        <button class="btn btn-success" type="submit">Update</button>
                    </form>
                </div>
                <div class="col-md-4 col-lg-2">
                    <h4>Creator Area Enabled</h4>
                    <form action="{{ route('admin.site_settings.update') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="setting" value="creator_area">
                        <select class="form-control" name="enabled" required>
                            <option value="1" @if (settings('creator_area_enabled')) selected @endif>Yes</option>
                            <option value="0" @if (!settings('creator_area_enabled')) selected @endif>No</option>
                        </select>
                        <button class="btn btn-success" type="submit">Update</button>
                    </form>
                    <br>
                </div>
                <div class="col-lg-3"></div>
                <div class="col-md-4 col-lg-2">
                    <h4>Character Editing Enabled</h4>
                    <form action="{{ route('admin.site_settings.update') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="setting" value="character">
                        <select class="form-control" name="enabled" required>
                            <option value="1" @if (settings('character_enabled')) selected @endif>Yes</option>
                            <option value="0" @if (!settings('character_enabled')) selected @endif>No</option>
                        </select>
                        <button class="btn btn-success" type="submit">Update</button>
                    </form>
                </div>
                <div class="col-md-4 col-lg-2">
                    <h4>Settings Enabled</h4>
                    <form action="{{ route('admin.site_settings.update') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="setting" value="settings">
                        <select class="form-control" name="enabled" required>
                            <option value="1" @if (settings('settings_enabled')) selected @endif>Yes</option>
                            <option value="0" @if (!settings('settings_enabled')) selected @endif>No</option>
                        </select>
                        <button class="btn btn-success" type="submit">Update</button>
                    </form>
                </div>
                <div class="col-md-4 col-lg-2">
                    <h4>Registration Enabled</h4>
                    <form action="{{ route('admin.site_settings.update') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="setting" value="registration">
                        <select class="form-control" name="enabled" required>
                            <option value="1" @if (settings('registration_enabled')) selected @endif>Yes</option>
                            <option value="0" @if (!settings('registration_enabled')) selected @endif>No</option>
                        </select>
                        <button class="btn btn-success" type="submit">Update</button>
                    </form>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-md-12 col-lg-6">
                    <h4>Alert Message</h4>
                    <form action="{{ route('admin.site_settings.update') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="setting" value="alert_message">
                        <textarea class="form-control" name="message" rows="5">{{ settings('alert_message') }}</textarea>
                        <button class="btn btn-success" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
