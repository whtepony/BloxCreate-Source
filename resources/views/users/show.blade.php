

@extends('master', [
    'pageTitle' => $user->username . '\'s Profile',
    'pageDescription' => 'View ' . $user->username . '\'s Profile on ' . config('app.name') . '. Join them in creating awesome friendships, items, games, and more!',
    'pageImage' => $user->headshot(),
    'bodyClass' => 'profile-page',
    'gridClass' => 'profile-grid'
])

@section('additional_meta')
    <meta name="user-info" data-id="{{ $user->id }}" data-username="{{ $user->username }}">
@endsection

@section('additional_js')
    <script src="{{ asset('js/site/inventory.js?v=4') }}"></script>
    <script src="{{ asset('js/site/favorites.js') }}"></script>
@endsection

@section('content')
    <div class="grid-x grid-margin-x">
        <div class="cell medium-3">
            <div class="profile-header">
                {{ $user->displayname }}@if ($user->verified)
                                    <i class="fas fa-shield-check text-success m2-2" style="font-size:16px; color: green;" title="This user is verified." data-toggle="tooltip"></i>
                                @endif @if ($user->usernameHistory()->count() > 0)
                    @php
                        $i = 1;
                        $len = $user->usernameHistory()->count();
                    @endphp
                    <i
                        class="icon icon-username-history profile-username-history"
                        title="Previous usernames: @foreach ($user->usernameHistory() as $username) {{ $username->username }}@php if ($i < $len) { echo ', '; } $i++; @endphp @endforeach"
                        data-position="right"
                        data-tooltip
                    ></i>
                @endif
				
            </div>
			<div style="font-size:15px;color:#666666; white-space: nowrap;">
                            <i>@</i>{{ $user->username }}
                        </div>
            <div class="container profile-avatar-container mb-15">
                <img class="profile-avatar" style="margin-top:10px;margin-bottom:10px;" src="{{ $user->thumbnail() }}">
                @auth
                    @if ($user->id != Auth::user()->id)
                        <div class="text-center">
                            @if ($areFriends)
                                <form action="{{ route('account.friends.update') }}" method="POST" style="display:inline-block;">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <input type="hidden" name="action" value="remove">
                                    <button class="button button-red" type="submit" title="Remove Friend" data-tooltip><i class="icon icon-unfriend"></i></button>
                                </form>
                            @elseif ($isPending)
                                <button class="button button-gray" type="submit" disabled><i class="icon icon-pending"></i></button>
                            @else
                                @if ($user->setting_friend == 'everyone')
                                    <form action="{{ route('account.friends.update') }}" method="POST" style="display:inline-block;">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <input type="hidden" name="action" value="send">
                                        <button class="button button-green" type="submit" title="Add Friend" data-tooltip><i class="icon icon-friend"></i></button>
                                    </form>
                                @endif
                            @endif
                            @if ($user->setting_message == 'everyone')
                                <a href="{{ route('account.inbox.compose', ['username' => $user->username]) }}" class="button button-blue" title="Send Message" data-tooltip><i class="icon icon-message"></i></a>
                            @endif
                        </div>
                    @endif
                @endauth
                @if ($user->online())
                    <div class="profile-status status-online" title="Last seen {{ $user->updated_at->diffForHumans() }}" data-position="bottom" data-tooltip></div>
                @else
                    <div class="profile-status status-offline" title="Last seen {{ $user->updated_at->diffForHumans() }}" data-position="bottom" data-tooltip></div>
                @endif
            </div>
            @auth
                @if (Auth::user()->power > 1)
                    <div class="text-center mb-15">
                        <a href="{{ route('admin.users', ['search' => $user->username]) }}" class="button button-blue" target="_blank">View in Panel</a>
                    </div>
                @endif
            @endauth
            @if (!empty($user->description))
                @if ($user->power < 4)
                    <div class="container profile-container profile-description-container mb-15">{!! nl2br(e($user->description)) !!}</div>
                @else
                    <div class="container profile-container profile-description-container mb-15">{!! nl2br($user->description) !!}</div>
                @endif
            @endif
            <div class="container profile-container profile-stats-container">
                <div class="profile-stat">
                    <div class="profile-stat-name">Profile Views</div>
                    <div class="profile-stat-result">{{ $user->views() }}</div>
                </div>
                <div class="profile-stat">
                    <div class="profile-stat-name">Date Joined</div>
                    <div class="profile-stat-result" style="width:35%;">{{ $user->created_at->format('M d, Y') }}</div>
                </div>
                <div class="profile-stat">
                    <div class="profile-stat-name">Friends Made</div>
                    <div class="profile-stat-result">{{ number_format($user->friends()->count()) }}</div>
                </div>
                <div class="profile-stat">
                    <div class="profile-stat-name">Forum Posts</div>
                    <div class="profile-stat-result">{{ number_format($user->postCount()) }}</div>
                </div>
            </div>
            @if(!$user->views() < 1)
            <br>
            <div class="container profile-container mb-15">
                <b>Recent Profile Views</b>
                <div style="word-wrap:break-word;color:#666;">
                @foreach($user->viewers()->latest()->get()->unique('viewer_id')->take(10) as $view)
                    <a href="{{ route('users.profile', ['id' => $view->viewer->id, 'username' => $view->viewer->username]) }}"><font color="#666">{{ $view->viewer->username }}</font></a>@unless($loop->last),@endunless
                @endforeach
                </div>
            </div>
            @endif
            @auth
                @if ($user->id != 1)
                    <div class="push-25"></div>
                    <a href="{{ route('report.index', ['type' => 'user', 'id' => $user->username]) }}" style="color:inherit;"><i class="icon icon-report item-report"></i> Report</a>
                @endif
            @endauth
            <div class="push-15 show-for-small-only"></div>
        </div>
        <div class="cell medium-9">
            @if (!empty($user->status()))
                <div class="push-25 hide-for-small-only"></div>
                <div class="container profile-container mb-15">
                    <strong>Personal Status:</strong> {{ $user->status() }}
                </div>
            @endif
			<div class="profile-header">Games</div>
            <div class="container profile-container profile-inventory-container mb-15">
                    <div class="profile-no-results">This user does not have any active games.</div>
            </div>
            <div class="profile-header">Achievements</div>
            <div class="container profile-container profile-achievements-container mb-15">
                <div class="grid-x grid-margin-x">
                    @forelse ($achievements as $achievement)
                        <div class="cell small-6 medium-2 profile-achievement">
                            <a href="/achievements">
                                <img class="profile-achievement-image" src="{{ $achievement['image'] }}">
                            </a>
                            <a href="/achievements" class="profile-achievement-title">{{ $achievement['name'] }}</a>
                            <div class="push-15 show-for-small-only"></div>
                        </div>
                    @empty
                        <div class="auto cell">
                            <div class="profile-no-results">This user does not have any achievements.</div>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="profile-header">Favorites</div>
            <div class="container profile-container profile-inventory-container mb-15">
                @if (empty($favoriteItems))
                    <div class="profile-no-results">This user does not have any favorites.</div>
                @else
                    <div id="favorites"></div>
                    <div id="favoritesButtons"></div>
                @endif
            </div>
            <div class="grid-x align-middle">
                <div class="cell auto">
                    <div class="profile-header">Friends</div>
                </div>
                <div class="cell shrink">
                    <a href="{{ route('users.friends', ['username' => $user->username]) }}" class="button button-blue profile-view-all">View All</a>
                </div>
            </div>
            <div class="container profile-container profile-friends-container mb-15">
                <div class="grid-x grid-margin-x">
                    @forelse ($friends as $friend)
                        <div class="cell small-6 medium-2 profile-friend">
                            <a href="{{ route('users.profile', ['id' => $friend->id,'username' => $friend->username]) }}">
                                <img class="profile-friend-avatar" src="{{ $friend->thumbnail() }}">
                            </a>
                            <a href="{{ route('users.profile', ['id' => $friend->id,'username' => $friend->username]) }}" class="profile-friend-username">
                                @if ($friend->online())
                                    <div class="profile-friend-status status-online" title="Last seen {{ $friend->updated_at->diffForHumans() }}" data-tooltip></div>
                                @else
                                    <div class="profile-friend-status status-offline" title="Last seen {{ $friend->updated_at->diffForHumans() }}" data-tooltip></div>
                                @endif
                                {{ $friend->username }}
                            </a>
                            <div class="push-15 show-for-small-only"></div>
                        </div>
                    @empty
                        <div class="auto cell">
                            <div class="profile-no-results">This user has no friends.</div>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="grid-x align-middle">
                <div class="cell auto">
                    <div class="profile-header">Groups</div>
                </div>
                <div class="cell shrink">
                    <a href="/profile/BLOXCity/groups" class="button button-blue profile-view-all">View All</a>
                </div>
            </div>
            <div class="container profile-container profile-groups-container">
                <div class="grid-x grid-margin-x">
                    @forelse ($user->groups as $group)
                    <div class="cell small-6 medium-2 profile-group">
                        <a href="{{ route('groups.show', $group->id) }}">
                            <img class="profile-group-avatar" src="{{ $group->thumbnail() }}" alt="{{ $group->name }}">
                        </a>
                        <a href="{{ route('groups.show', $group->id) }}" class="profile-group-name">
                            {{ $group->name }}
                        </a>
                    </div>
                    @empty
                    <div class="profile-no-results">This user is not in any groups.</div>
                    @endforelse
                </div>
            </div>
            <div class="push-15"></div>
            <div class="profile-header">Inventory</div>
            <div class="container profile-container profile-inventory-container">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-12 medium-2">
                        <div class="profile-inventory-category" data-category="collectibles">Collectibles</div>
                        <div class="profile-inventory-category" data-category="heads">Heads</div>
                        <div class="profile-inventory-category" data-category="hats">Hats</div>
                        <div class="profile-inventory-category" data-category="faces">Faces</div>
                        <div class="profile-inventory-category" data-category="accessories">Accessories</div>
                        <div class="profile-inventory-category" data-category="t-shirts">T-Shirts</div>
                        <div class="profile-inventory-category" data-category="shirts">Shirts</div>
                        <div class="profile-inventory-category" data-category="pants">Pants</div>
                        <div class="push-15 show-for-small-only"></div>
                    </div>
                    <div class="cell small-12 medium-10">
                        <div id="inventory"></div>
                        <div id="inventoryButtons"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
