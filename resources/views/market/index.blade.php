@extends('master', [
    'pageTitle' => 'Market',
    'bodyClass' => 'market-page',
    'gridClass' => 'market-grid'
])

@section('additional_js')
    <script src="{{ asset('js/site/market.js?v=8') }}"></script>
@endsection

@section('content')
    <style>
        .ribbon {
        position: absolute;
        top: -5px;
        left: -5px;
        z-index: 1;
        overflow: hidden;
        width: 75px;
        height: 75px;
        text-align: right;
    }

    .ribbon span {
        font-size: 10px;
        font-weight: bold;
        color: #FFF;
        text-transform: uppercase;
        text-align: center;
        line-height: 20px;
        transform: rotate(-45deg);
        -webkit-transform: rotate(-45deg);
        width: 100px;
        display: block;
        background: #79A70A;
        background: linear-gradient(#298EFF 0%,#0161C0 100%);
        box-shadow: 0 3px 10px -5px rgba(0,0,0,1);
        position: absolute;
        top: 19px;
        left: -21px;
    }

    .ribbon span::before {
        content: "";
        position: absolute;
        left: 0px;
        top: 100%;
        z-index: -1;
        border-left: 3px solid #0161C0;
        border-right: 3px solid transparent;
        border-bottom: 3px solid transparent;
        border-top: 3px solid #0161C0;
    }

    .ribbon span::after {
        content: "";
        position: absolute;
        right: 0px;
        top: 100%;
        z-index: -1;
        border-left: 3px solid transparent;
        border-right: 3px solid #0161C0;
        border-bottom: 3px solid transparent;
        border-top: 3px solid #0161C0;
    }

    .market-item-cell {
        position: relative;
    }
    </style>
    <div class="grid-x grid-margin-x mb-25">
        <div class="auto cell">
            <div class="market-header">Market</div>
        </div>
        <div class="shrink cell">
            @auth
            <a href="{{ route('creator-area.index') }}" class="button button-green">Create</a>
            @endauth
        </div>
    </div>
    <div class="grid-x grid-margin-x mb-15">
        <div class="cell small-12 medium-2">
            <select class="form-input" id="category-selector">
                <option value="recent" selected>Recent</option>
                <option value="heads">Heads</option>
                <option value="hats">Hats</option>
                <option value="faces">Faces</option>
                <option value="accessories">Accessories</option>
                <option value="t-shirts">T-Shirts</option>
                <option value="shirts">Shirts</option>
                <option value="pants">Pants</option>
                <option value="sets">Sets</option>
            </select>
        </div>
        <div class="cell small-12 medium-10">
            <div class="push-5 show-for-small-only"></div>
            <input class="form-input" id="search" type="text" placeholder="Search and press enter">
        </div>
    </div>
    @if (!settings('market_purchases_enabled'))
        <div class="alert alert-warning market-purchases-alert">
            Market purchases are temporarily unavailable. Items may be browsed but are unable to be purchased or traded.
        </div>
    @endif
    <div class="market-header" id="header">Recent</div>
    <div class="container">
        <div class="market-search-results" id="results-for" style="display:none;"></div>
        <div id="items"></div>
        <div class="market-load-more" style="display:none;"><a id="load-more">Load more...</a></div>
    </div>
@endsection