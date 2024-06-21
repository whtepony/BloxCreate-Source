@extends('master', [
    'pageTitle' => $group->name,
    'bodyClass' => 'group-page'
])

@section('additional_meta')
    <meta name="id" content="{{ $group->id }}">
@endsection

@section('additional_js')
    <script src="{{ asset('js/site/group.js?v=8') }}"></script>
@endsection

@section('content')
    <div class="container mb-25">
        <div class="grid-x grid-margin-x">
            <div class="cell small-12 medium-3 text-center">
                <img src="{{ $group->thumbnail() }}" class="group-icon">
                <div class="push-25"></div>
                @auth
                    @if(Auth::user()->id !== $group->owner->id)
                        <form action="{{ route('groups.status') }}" method="POST">
                            @csrf
                            <input type="hidden" name="action" value="{{ Auth::user()->inGroup($group->id) ? 'leave' : 'join' }}">
                            <input type="hidden" name="id" value="{{ $group->id }}">
                            <button type="submit" class="button button-block {{ Auth::user()->inGroup($group->id) ? 'button-red' : 'button-green' }}">
                                {{ Auth::user()->inGroup($group->id) ? 'Leave' : 'Join' }}
                            </button>
                        </form>
                    @endif
                    <div class="push-10"></div>
                    @if(Auth::user()->id == $group->owner->id)
                        <a href="{{ route('groups.edit', ['id' => $group->id]) }}" class="button button-block button-blue">Manage</a>
                    @endif
                @endauth
            </div>
            <div class="cell small-12 medium-9">
                <div class="group-name">
                    {{ $group->name }}
                    @if ($group->verified)
                        <i class="fas fa-shield-check text-success ml-1" style="font-size:16px; color: green;" title="This group is verified." data-toggle-modal="#verified-modal"></i>
                    @endif
                </div>
                <div class="group-description">{{ $group->description }}</div>
            </div>
        </div>
    </div>
    <div class="container group-stats-container mb-25">
        <div class="grid-x grid-margin-x">
            <div class="cell small-12 medium-4">
                <div class="group-stat-result">
                    <a href="{{ route('users.profile', ['id' => $group->owner->id, 'username' => $group->owner->username]) }}">{{ $group->owner->username }}</a>
                </div>
                <div class="group-stat-name">Owner</div>
                <div class="push-15 show-for-small-only"></div>
            </div>
            <div class="cell small-12 medium-4">
                <div class="group-stat-result">{{ $group->membersCount() }}</div>
                <div class="group-stat-name">Members</div>
                <div class="push-15 show-for-small-only"></div>
            </div>
            <div class="cell small-12 medium-4">
                <div class="group-stat-result group-stat-vault">${{ $group->vault }}</div>
                <div class="group-stat-name">Vault</div>
            </div>
        </div>
    </div>
    <div class="container group-members-container">
        <div class="grid-x grid-margin-x align-middle">
            <div class="cell auto">
                <h5>Members</h5>
            </div>
            <div class="cell shrink">
                <select class="form-input" id="ranks">
                    @foreach($group->ranks as $rank)
                        <option value="{{ $rank->rank }}">{{ $rank->name }} ({{ $rank->count() }})</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div id="members" class="grid-x grid-margin-x">
        </div>
    </div>
@endsection