

@php
    use App\Models\User;

    $teamMembers = User::where([['power', '>', 0] ,['id', '!=', 1]])->orderBy('id', 'ASC')->get();
@endphp

@forelse ($teamMembers as $teamMember)
    @php
        switch ($teamMember->power) {
            case 1:
                $rank = 'Asset Creator';
                $class = 'asset';
                break;
            case 2:
                $rank = 'Moderator';
                $class = 'moderator';
                break;
            case 3:
            case 4:
            case 5:
                $rank = 'Administrator';
                $class = 'administrator';
                break;
        }
    @endphp

    <div class="grid-x grid-margin-x team-member">
        <div class="cell small-4 medium-3">
            <a href="{{ route('users.profile', ['id' => $teamMember->id, 'username' => $teamMember->username]) }}">
                <img class="team-member-avatar" src="{{ $teamMember->thumbnail() }}">
            </a>
        </div>
        <div class="cell small-8 medium-9">
            <a href="{{ route('users.profile', ['id' => $teamMember->id, 'username' => $teamMember->username]) }}" class="team-member-username">{{ $teamMember->username }}</a>
            <div class="team-member-rank rank-{{ $class }}"><i class="fas fa-gavel"></i> {{ $rank }}</div>
            <div class="team-member-description">{{ $teamMember->description ?? 'This team member has no description.' }}</div>
        </div>
    </div>
@empty
    <p>There are currently no team members.</p>
@endforelse
