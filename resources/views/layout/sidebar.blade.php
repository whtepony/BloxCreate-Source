

@php
    use App\Models\Friend;
    use App\Models\Message;
    use App\Models\Item;
    use App\Models\Report;

    if (Auth::check()) {
        $friendRequestCount = number_format(Friend::where([['receiver_id', '=', Auth::user()->id], ['status', '=', 'pending']])->count());
        $unreadMessageCount = number_format(Message::where([['receiver_id', '=', Auth::user()->id], ['seen', '=', false]])->count());
        $pendingAssets = 0;

        if (Auth::user()->power > 1) {
            $pendingItems = Item::where('status', '=', 'pending')->count();
            $pendingReports = Report::where('seen', '=', false)->count();
        }
    }
@endphp

<div class="sidebar hide-for-large hide">
    <div class="sidebar-inner">
        <ul class="sidebar-items">
            <li class="item">
                <a href="{{ (Auth::check()) ? route('dashboard') : route('landing') }}">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>
            </li>
            <li class="item">
                <a href="{{ route('games.index') }}">
                    <i class="fas fa-gamepad"></i>
                    <span>Games</span>
                </a>
            </li>
            <li class="item">
                <a href="{{ route('market.index') }}">
                    <i class="fas fa-store-alt"></i>
                    <span>Market</span>
                </a>
            </li>
            <li class="item">
                <a href="{{ route('forum.index') }}">
                    <i class="fas fa-comments"></i>
                    <span>Forum</span>
                </a>
            </li>
            <li class="item">
                <a href="{{ route('users.index') }}">
                    <i class="fas fa-search"></i>
                    <span>Users</span>
                </a>
            </li>
            <li class="item">
                <a href="{{ route('upgrade.index') }}">
                    <i class="fas fa-shopping-basket"></i>
                    <span>Upgrade</span>
                </a>
            </li>
            @auth
                <li class="item">
                    <a href="{{ route('creator-area.index') }}">
                        <i class="fas fa-plus"></i>
                        <span>Create</span>
                    </a>
                </li>
            @endauth
            <li class="item">
                <a href="{{ config('blox.domains.blog') }}">
                    <i class="fas fa-pencil"></i>
                    <span>Blog</span>
                </a>
            </li>
        </ul>
        @auth
            <div class="sidebar-divider"></div>
            <ul class="sidebar-items">
                <li class="item">
                    <a href="{{ route('account.money.index', ['from' => 'cash']) }}">
                        <i class="icon icon-cash"></i>
                        <span>{{ number_format(Auth::user()->currency_cash) }} Cash</span>
                    </a>
                </li>
                <li class="item">
                    <a href="{{ route('account.money.index', ['from' => 'coins']) }}">
                        <i class="icon icon-coins"></i>
                        <span>{{ number_format(Auth::user()->currency_coins) }} Coins</span>
                    </a>
                </li>
                <li class="item">
                    <a href="{{ route('account.friends.index') }}">
                        <i class="icon icon-friends"></i>
                        <span>{{ $friendRequestCount }} Friend Requests</span>
                    </a>
                </li>
                <li class="item">
                    <a href="{{ route('account.inbox.index') }}">
                        <i class="icon icon-inbox"></i>
                        <span>{{ $unreadMessageCount }} Messages</span>
                    </a>
                </li>
                @if (Auth::user()->power > 0)
                    <li class="item">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="icon icon-staff"></i>
                            <span>Panel</span>
                        </a>
                    </li>
                @endif
            </ul>
        @endauth
    </div>
</div>
