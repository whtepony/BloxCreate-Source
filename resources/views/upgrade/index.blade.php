

@extends('master', [
    'pageTitle' => 'Upgrade',
    'bodyClass' => 'upgrade-page',
    'gridFluid' => true
])

@section('content')
    @if (!settings('upgrades_enabled'))
        <div class="container construction-container">
            <i class="icon icon-sad construction-icon"></i>
            <div class="construction-text">Sorry, Real Life Transactions are unavailable right now for maintenance. Try again later.</div>
        </div>
    @else
        <div class="grid-x grid-margin-x mb-25">
            <div class="cell small-6 medium-3">
                <div class="upgrade-header bronze-vip">Bronze</div>
                <div class="upgrade-title bronze-vip">
                    <div class="upgrade-title-price">3.49</div>
                    <div class="upgrade-title-duration">Month</div>
                </div>
                <div class="upgrade-benefits">
                    <div class="upgrade-benefit"><strong>30</strong> Daily Cash</div>
                    <div class="upgrade-benefit">Join up to <strong>25</strong> Groups</div>
                    <div class="upgrade-benefit"><strong>NO</strong> Paid Ads</div>
                    <div class="upgrade-benefit"><strong>2</strong> Special Items</div>
                    <div class="upgrade-button-holder">
                        <a href="{{ route('upgrade.show', ['plan' => 'bronze-vip']) }}" class="upgrade-button bronze-vip">Buy Now</a>
                    </div>
                </div>
                <div class="push-15 show-for-small-only"></div>
            </div>
            <div class="cell small-6 medium-3">
                <div class="upgrade-header silver-vip">Silver</div>
                <div class="upgrade-title silver-vip">
                    <div class="upgrade-title-price">6.49</div>
                    <div class="upgrade-title-duration">Month</div>
                </div>
                <div class="upgrade-benefits">
                    <div class="upgrade-benefit"><strong>70</strong> Daily Cash</div>
                    <div class="upgrade-benefit">Join up to <strong>50</strong> Groups</div>
                    <div class="upgrade-benefit"><strong>NO</strong> Paid Ads</div>
                    <div class="upgrade-benefit"><strong>3</strong> Special Items</div>
                    <div class="upgrade-button-holder">
                        <a href="{{ route('upgrade.show', ['plan' => 'silver-vip']) }}" class="upgrade-button silver-vip">Buy Now</a>
                    </div>
                </div>
                <div class="push-15 show-for-small-only"></div>
            </div>
            <div class="cell small-6 medium-3">
                <div class="upgrade-header gold-vip">Gold</div>
                <div class="upgrade-title gold-vip">
                    <div class="upgrade-title-price">11.49</div>
                    <div class="upgrade-title-duration">Month</div>
                </div>
                <div class="upgrade-benefits">
                    <div class="upgrade-benefit"><strong>130</strong> Daily Cash</div>
                    <div class="upgrade-benefit">Join up to <strong>100</strong> Groups</div>
                    <div class="upgrade-benefit"><strong>NO</strong> Paid Ads</div>
                    <div class="upgrade-benefit"><strong>3</strong> Special Items</div>
                    <div class="upgrade-button-holder">
                        <a href="{{ route('upgrade.show', ['plan' => 'gold-vip']) }}" class="upgrade-button gold-vip">Buy Now</a>
                    </div>
                </div>
                <div class="push-15 show-for-small-only"></div>
            </div>
            <div class="cell small-6 medium-3">
                <div class="upgrade-header platinum-vip">Platinum</div>
                <div class="upgrade-title platinum-vip">
                    <div class="upgrade-title-price">18.95</div>
                    <div class="upgrade-title-duration">Month</div>
                </div>
                <div class="upgrade-benefits">
                    <div class="upgrade-benefit"><strong>10</strong> Daily Cash</div>
                    <div class="upgrade-benefit">Join up to <strong>15</strong> Groups</div>
                    <div class="upgrade-benefit"><strong>NO</strong> Paid Ads</div>
                    <div class="upgrade-benefit"><strong>1</strong> Special Item</div>
                    <div class="upgrade-button-holder">
                        <a href="{{ route('upgrade.show', ['plan' => 'platinum-vip']) }}" class="upgrade-button platinum-vip">Buy Now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid-x grid-margin-x">
            <div class="cell medium-6 hide-for-small-only">
                <img class="upgrade-cash-avatar" src="{{ storage('web-img/builder.png') }}">
            </div>
            <div class="cell medium-6">
                <div class="upgrade-cash-container">
                    <div class="upgrade-cash-title">Looking for Cash?</div>
                    <div class="upgrade-cash-description">With Cash, you can buy shiny items and more!</div>
                    <a href="{{ route('upgrade.show', ['plan' => 'cash']) }}" class="upgrade-button cash">Check It Out</a>
                </div>
            </div>
        </div>
    @endif
@endsection
