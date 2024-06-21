

@if (settings('maintenance_enabled') && session()->has('maintenance_code'))
    <div class="alert alert-error">
        <div class="grid-x grid-margin-x align-middle">
            <div class="cell shrink left">
                <i class="icon icon-error"></i>
            </div>
            <div class="cell auto text-center">
                You are in maintenance mode.
                &nbsp;&nbsp;
                <a href="{{ route('maintenance.exit') }}" class="button button-green" style="font-size:11px;">Exit</a>
            </div>
            <div class="cell shrink right">
                <i class="icon icon-error"></i>
            </div>
        </div>
    </div>
@endif

@if (count($errors) > 0)
    <div class="alert alert-error">
        @foreach ($errors->all() as $error)
            <div>{!! $error !!}</div>
        @endforeach
    </div>
@endif

@if (session()->has('success_message'))
    <div class="alert alert-success">
        {!! session()->get('success_message') !!}
    </div>
@endif
