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
                <form class="d-flex mx-2 mb-2 comment-form" data-post-id="{{ $post->id }}">
                    @csrf
                    <input name="body" class="form-control" placeholder="Write a comment"></input>
                    <button type="submit" class="btn btn-primary ml-2">Submit</button>
                </form>
            </div>
        @endforeach
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const commentForms = document.querySelectorAll('.comment-form');
        // const commentForms = $('.your-class');
            console.log("from scripts");
        commentForms.forEach(form => {
            console.log("forms");
            form.addEventListener('submit', function(event) {
                event.preventDefault();
    
                const postId = this.dataset.postId;
                const body = this.querySelector('input[name="body"]').value;
    
                fetch(`/posts/${postId}/comments`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ body: body })
                })
                .then(response => {
                    if (response.ok) {
                        location.reload(); // Refresh the page
                    } else {
                        throw new Error('Error creating comment');
                    }
                })
                .catch(error => {
                    console.error(error);
                });
            });
        });
    });
    
    </script>
@endsection

@section('script')
@endsection
