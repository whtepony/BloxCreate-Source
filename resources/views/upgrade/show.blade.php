

@extends('master', [
    'pageTitle' => $title,
    'bodyClass' => 'upgrade-page',
    'gridFluid' => true
])

@section('content')
    <h5>Purchase {{ $title }}</h5>
    <div class="grid-x grid-margin-x mb-10">
        @forelse ($plans as $upgradePlan)
            <div class="cell small-6 medium-3">
                <div class="upgrade-header {{ $plan }}">{{ $upgradePlan['name'] }}</div>
                <div class="upgrade-title {{ $plan }}">
                    <div class="upgrade-title-price">{{ $upgradePlan['price'] }}</div>
                </div>
                <div class="upgrade-benefits">
                    <div class="upgrade-button-holder">
                        <form action="{{ route('upgrade.paypal') }}" method="POST">
                            {{ csrf_field() }}
                            <button class="upgrade-button {{ $plan }}" style="margin-top:0;">Buy Now</button>
                        </form>
                    </div>
                </div>
                <div class="push-15"></div>
            </div>
        @empty
            <div class="cell auto">There are currently no {{ $title }} plans available. Check again later.</div>
        @endforelse
    </div>
    @if ($plan != 'cash')
        <div class="grid-x grid-margin-x mb-25">
            <div class="cell medium-4 hide-for-small-only">
                <img class="upgrade-cash-avatar" src="{{ storage('web-img/error.png') }}">
            </div>
            <div class="cell medium-6">
                <div class="upgrade-cash-container">
                    <div class="upgrade-cash-title">Friendly Notice</div>
                    <div class="upgrade-cash-description">VIP Memberships do not automatically renew as of now. You will need to purchase it again if you wish to renew once it has expired.</div>
                </div>
            </div>
        </div>
    @endif
    <a href="{{ route('upgrade.index') }}">Return to Upgrades</a>
@endsection
