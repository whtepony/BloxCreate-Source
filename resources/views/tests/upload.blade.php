

@extends('master', [
    'pageTitle' => 'Upload File'
])

@section('content')
    <div class="container">
        <form action="/fast1/upload" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="file" name="uploaded_file">
            <button class="button button-blue" type="submit">Upload</button>
        </form>
    </div>
@endsection
