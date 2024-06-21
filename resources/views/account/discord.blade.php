

@extends('master', [
    'pageTitle' => 'Verify Discord Account',
    'bodyClass' => 'discord-page',
    'gridClass' => 'discord-grid'
])

@section('additional_css')
    @if (empty(Auth::user()->discord_id) && !empty(Auth::user()->discord_code))
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <style>input[name="code"] { cursor: pointer; }</style>
    @endif
@endsection

@section('content')
    <h5>Verify Discord Account</h5>
    <div class="container">
        <div class="text-center">
            @if (empty(Auth::user()->discord_id))
                <i class="icon icon-discord"></i>
                <div class="discord-title">Verify your Discord Account</div>
                @if (empty(Auth::user()->discord_code))
                    <p>Click the 'Generate' button below to generate a unique key which you will then DM to our bot.</p>
                    <form action="{{ route('account.discord.update') }}" method="POST">
                        {{ csrf_field() }}
                        <button class="button button-block button-green">Generate Code</button>
                    </form>
                @else
                    <p>To finish this process, DM the code posted below to our verification bot.</p>
                    <input class="form-input" type="text" name="code" placeholder="Discord Code" value="{{ Auth::user()->discord_code }}" readonly>
                @endif
            @else
                <i class="icon icon-discord has-verified"></i>
                <div class="discord-title">Verify your Discord Account</div>
                <p>You have verified your account on our Discord</p>
                <p>If you would like to unlink your Discord account, click the 'Unlink' button.</p>
                <form action="{{ route('account.discord.update') }}" method="POST">
                    {{ csrf_field() }}
                    <button class="button button-block button-red">Unlink Account</button>
                </form>
            @endif
        </div>
    </div>
@endsection

@section('additional_js')
    @if (empty(Auth::user()->discord_id) && !empty(Auth::user()->discord_code))
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script>
            $(function() {
                $('input[name="code"]').click(function() {
                    this.select();
                    document.execCommand('copy');

                    toastr.success('Code copied to clipboard!');
                });
            });
        </script>
    @endif
@endsection
