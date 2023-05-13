@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
       <div class="col-md-8 offset-md-2">
           <h2>My Posts</h2>
           @if ($posts->isEmpty())
               <div class="alert alert-info" role="alert">
                   No posts found.
               </div>
           @else
               @foreach ($posts as $post)
                <a href="{{ route('posts.show', $post) }}" style="text-decoration: none; color: inherit;">
                  <div class="card my-3">
                      <div class="card-header">
                          <h5 class="card-title h2">{{ $post->title }}</h5>
                          <h6 class="card-subtitle mb-2 text-muted">Author: {{ $post->user->name }}</h6>
                      </div>
                      <div class="card-body">
                          <p class="card-text">{{ $post->body }}</p>
                      </div>
                  </div>
                </a>
               @endforeach
           @endif
       </div>
   </div>
</div>
@endsection