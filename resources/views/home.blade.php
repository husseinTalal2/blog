@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($posts as $post)
            <div class="card mb-4">
                <a href="{{ route('posts.show', $post) }}" style="text-decoration: none; color: inherit;">
                    <div class="card-body">
                        <h2 class="card-title">{{ $post->title }}</h2>
                        <h5 class="card-subtitle mb-2 text-muted">Author: {{ $post->user->name }}</h5>
                        <p class="card-text">{{ $post->body }}</p>
                        <p class="card-text">Comments: {{ $post->comments_count }}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
