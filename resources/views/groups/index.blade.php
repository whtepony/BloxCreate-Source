

@extends('master', [
    'pageTitle' => 'Groups',
    'bodyClass' => 'groups-page',
    'gridFluid' => true
])

@section('content')
    <div class="container mb-15">
        <div class="grid-x align-middle mb-15">
            <div class="cell auto">
                <h5>Search Groups</h5>
            </div>
            @auth
                <div class="cell shrink">
                    <a href="{{ route('groups.create') }}" class="button button-green">Create</a>
                </div>
            @endauth
        </div>
        <form method="GET">
            <input class="form-input" type="text" name="search" value="{{ request()->search }}" placeholder="Search and press enter">
        </form>
    </div>
    @forelse ($groups as $group)
        <div class="container group-container">
            <div class="grid-x grid-margin-x align-middle">
                <div class="cell small-12 medium-2 text-center">
                    <a href="{{ route('groups.show', ['id' => $group->id]) }}">
                        <img class="group-icon" src="{{ $group->thumbnail() }}">
                    </a>
                </div>
                <div class="cell small-12 medium-8">
                    <a href="{{ route('groups.show', ['id' => $group->id]) }}" class="group-name">{{ $group->name }} @if ($group->verified)<i class="fas fa-shield-check text-success ml-1" style="font-size:16px; color: green;"" title="This user is verified." data-toggle-modal="#verified-modal"></i>
                                @endif</a>
                    <div class="group-description">{{ Str::limit($group->description, 400) }}</div>
                </div>
                <div class="cell small-12 medium-2 text-center">
                    <div class="group-member-count">{{ $group->membersCount() }}</div>
                    <div class="group-members-text">Members</div>
                </div>
            </div>
        </div>
    @empty
        <div class="container">
            <p>No groups found.</p>
        </div>
    @endforelse
    {{ $groups->onEachSide(1)->links('pagination.default') }}
@endsection
