<!-- edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Post</h1>
        <form action="{{ route('posts.update', $post) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" id="body" name="body" rows="5" required>{{ $post->body }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    <script>
    const form = document.getElementById('edit-post-form');
    form.addEventListener('submit', (event) => {
        event.preventDefault(); // Prevent the default form submission

        const postId = document.getElementById('post-id').value;
        const title = document.getElementById('title').value;
        const body = document.getElementById('body').value;

        // Prepare the data object to be sent in the request
        const data = {
            title: title,
            body: body,
            _method: 'POST', // Set the method to PUT to match the Laravel route
            _token: '{{ csrf_token() }}' // Include the CSRF token
        };

        fetch(`/posts/${postId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
          if (response.ok) {
            window.location.replace = "/posts/" + data; // Redirect to the post page
          }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

</script>

@endsection
