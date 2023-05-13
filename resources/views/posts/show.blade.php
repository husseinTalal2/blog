@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title">{{ $post->title }}</h2>
                <h5 class="card-subtitle mb-2 text-muted">Author: {{ $post->user->name }}</h5>
                <p class="card-text">{{ $post->body }}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Comments</h4>
                @if ($post->comments->isEmpty())
                    <p>No comments found.</p>
                @else
                    @foreach ($post->comments as $comment)
                        <div class="mb-3">
                            <h6 class="card-subtitle mb-2 text-muted">{{ $comment->user->name }}</h6>
                            <p class="card-text">{{ $comment->body }}</p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
