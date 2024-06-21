@extends('master', [
    'pageTitle' => 'Create Group',
    'bodyClass' => 'forum-page',
    'gridClass' => 'forum-grid'
])

@section('content')
    <div class="forum-header forum-thread-header">
        Create Group
    </div>
    <div class="container forum-container">
        <form action="{{ route('groups.purchase') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input class="form-input" type="text" name="name" placeholder="Group Name" required>
            <input class="form-input" name="description" placeholder="Group Description..." rows="5" required>
            <input class="upload-input" style="border:0;" type="file" name="image" required>
            <button class="forum-button" type="submit" @if(Auth::user()->currency_cash < 25) disabled @endif>
                Create
            </button>
            <p style="color: green; font-style: italic;">This will cost 25 Cash</p>
        </form>
    </div>
@endsection