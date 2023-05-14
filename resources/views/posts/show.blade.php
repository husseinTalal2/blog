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
                            @if (auth()->check() && $comment->user_id === auth()->user()->id)
                                <!-- <form >
                                    @csrf -->
                                    <button id="{{$comment->id}}" type="submit" class="btn btn-danger delete-comment">Delete</button>
                                <!-- </form> -->
                            @endif
                        </div>
                        <hr />
                        <script>
                            document.getElementById("{{$comment->id}}").addEventListener('click', function(event) {
                                fetch(`/posts/{{ $post->id }}/comments/{{$comment->id}}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    }
                                })
                                .then(response => {
                                    if (response.ok) {
                                        location.reload(); // Refresh the page
                                    } else {
                                        throw new Error('Error deleting comment');
                                    }
                                })
                                .catch(error => {
                                    console.error(error);
                                });
                            });
                        </script>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-comment');

        deleteButtons.forEach(button => {
           
        });
    });

    </script>
@endsection
