

@if (settings('alert_enabled') && !empty(settings('alert_message')))
    <div class="site-banner">
        {!! settings('alert_message')!!}
    </div>
@endif
