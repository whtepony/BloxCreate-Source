

@php
    $positions = [];
@endphp

<div class="grid-x grid-margin-x">
    @forelse ($positions as $position)
        <div class="cell medium-4">
            <div class="container mb-15" style="padding:5px 15px;padding-top:20px;padding-bottom:20px;text-align:center;">
                <div style="font-size:20px;"><strong>{{ $position['title'] }}</strong></div>
                <div style="font-size:18px;opacity:.8;"><strong>{{ $position['amount'] }} open {{ ($position['amount'] == 1) ? 'position' : 'positions' }}</strong></div>
            </div>
        </div>
    @empty
        <div class="cell auto">There are currently no open positions. Check back soon! :-)</div>
        <div class="push-15"></div>
    @endforelse
</div>
<div><small style="font-style:italic;">Currently all positions require you work voluntarily from home.</small></div>
<hr>
<p>Please email {!! mailto(config('blox.emails.careers')) !!} with job title and a resume to apply.</p>
<p>You must have no prior bans longer than 1 day and be at least 16 years old to apply.</p>
<p>If you are unsure how to apply, please contact an Administrator.</p>
