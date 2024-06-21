

@extends('master', [
    'pageTitle' => 'Admin'
])

@section('additional_js')
    <script>
        var ownsTroll = false;

        function troll()
        {
            $('#mainContainer').hide();
            $('#trollContainer').show();
        }

        function untroll()
        {
            $('#trollContainer').hide();
            $('#mainContainer').show();
        }
    </script>
@endsection

@section('content')
    <h5>{{ config('app.name') }} Admin Panel</h5>
    <div class="container" id="mainContainer">
        <p>Welcome, {{ (Auth::check()) ? Auth::user()->username : 'guest' }}!</p>
        <p>What would you like to do?</p>
        <button onclick="troll()" class="button button-red">Ban User</button>
        <button onclick="troll()" class="button button-red">Enable Maintenance</button>
        <button onclick="troll()" class="button button-red">Change Site Banner</button>
        <button onclick="troll()" class="button button-red">Create Item</button>
        <button onclick="troll()" class="button button-red">Grant Currency</button>
    </div>
    <div class="container text-center" id="trollContainer" style="display:none;">
        <h4>You just got trolled</h4>
        <div>
            <img src="{{ asset('frick.png') }}">
        </div>
        <button onclick="untroll()" class="button button-blue">Go Back</button>
    </div>
@endsection
