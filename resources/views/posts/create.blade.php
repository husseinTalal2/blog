@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create a New Post</h2>
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea name="body" id="body" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
