@extends('master', [
    'pageTitle' => 'Users',
    'bodyClass' => 'users-page'
])

@section('content')
    <div class="container">
        <div class="grid-x grid-margin-x mb-25">
            <div class="auto cell">
                <div class="search-header">Search Users</div>
            </div>
            <div class="shrink cell">
                <p>{{ number_format($totalUsers) }} Total Users</p>
            </div>
        </div>
        <form action="{{ route('users.index') }}" method="GET">
            <input class="form-input" type="text" name="search" placeholder="Search and press enter">
        </form>
    </div>
    <div class="push-15"></div>
    <div id="users">
        @forelse ($users as $user)
            <div class="container user-container">
                <div class="grid-x grid-margin-x align-middle">
                    <div class="cell small-3 medium-2 text-center">
                        <a href="{{ route('users.profile', ['id' => $user->id, 'username' => $user->username]) }}">
                            <div class="user-avatar">
                                <img class="user-avatar-image" src="{{ $user->headshot() }}">
                            </div>
                        </a>
                        <a href="{{ route('users.profile', ['id' => $user->id, 'username' => $user->username]) }}" class="user-username">{{ $user->username }}
                            @if ($user->verified)
                                <i class="fas fa-shield-check text-success m2-2" style="font-size:16px; color: green;" title="This user is verified." data-toggle="tooltip"></i>
                            @endif
                        </a>
                    </div>
                    <div class="cell small-6 medium-8">
                        @if ($user->power < 4)
                            <div class="user-description">{{ $user->description }}</div>
                        @else
                            <div class="user-description">{!! $user->description !!}</div>
                        @endif
                        @if ($user->usernameHistory()->count() > 0)
                            @php
                                $i = 1;
                                $len = $user->usernameHistory()->count();
                            @endphp
                            <div style="word-break:break-word;font-size:12px;padding-top:5px;color:#444;">
                                <font style="font-weight:600;">Previous Usernames: </font>
                                @foreach ($user->usernameHistory() as $username)
                                    {{ $username->username }}
                                    @if ($i < $len)
                                        , 
                                    @endif
                                    @php $i++; @endphp
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="cell small-3 medium-2">
                        <div style="font-size:12px;color:#666666; white-space: nowrap;">
                            Last seen {{ $user->updated_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="container">
                <p>No users found.</p>
            </div>
        @endforelse
    </div>
    {{ $users->onEachSide(1)->links('pagination.default') }}
@endsection