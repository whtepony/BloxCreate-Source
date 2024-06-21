

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
