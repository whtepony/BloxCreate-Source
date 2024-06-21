

@extends('master', [
    'pageTitle' => 'Money',
    'bodyClass' => 'money-page'
])

@section('content')
    @if (request()->from)
        @if (request()->from == 'coins')
            <div class="alert alert-coins">
                <i class="icon icon-coins"></i> Here you are able to convert your Coins to Cash, or Cash to Coins!
            </div>
        @elseif (request()->from == 'cash')
            <div class="alert alert-cash">
                <i class="icon icon-cash"></i> Here you are able to convert your Cash to Coins, or Coins to Cash!
            </div>
        @endif
    @endif
    <div class="grid-x grid-margin-x mb-25">
        <div class="cell medium-6">
            <div class="container text-center">
                <div class="currency-amount text-cash">{{ number_format(Auth::user()->currency_cash) }}</div>
                <div class="currency-title">cash</div>
            </div>
            <div class="push-25 show-for-small-only"></div>
        </div>
        <div class="cell medium-6">
            <div class="container text-center">
                <div class="currency-amount text-coins">{{ number_format(Auth::user()->currency_coins) }}</div>
                <div class="currency-title">coins</div>
            </div>
            <div class="push-25 show-for-small-only"></div>
        </div>
    </div>
    <div class="text-center">
        <button class="money-button" data-toggle="convert-modal">Convert Currencies</button>
    </div>
    <div class="modal reveal" id="convert-modal" data-reveal>
        <form action="{{ route('account.money.update') }}" method="POST">
            {{ csrf_field() }}
            <div class="modal-title">Convert</div>
            <div class="modal-content">
                <p>Current Rate: <span class="text-coins">10 Coins</span> = <span class="text-cash">1 Cash</span></p>
                <input class="form-input" type="number" name="amount" placeholder="Amount" required>
                <select class="form-input" name="currency">
                    <option value="coins" selected>Coins to Cash</option>
                    <option value="cash">Cash to Coins</option>
                </select>
            </div>
            <div class="modal-footer">
                <div class="modal-buttons">
                    <button class="modal-button" type="submit">CONVERT</button>
                    <button class="modal-button" data-close>CANCEL</button>
                </div>
            </div>
        </form>
    </div>
@endsection
