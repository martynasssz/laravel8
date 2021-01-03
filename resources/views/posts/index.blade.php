@extends('layouts.app')

@section('title', 'Blog Post') 

@section('content')
{{--  @each('posts.partials.post', $posts, 'post' )  --}}


@forelse($posts as $key => $post)
    @include('posts.partials.post')

    @if($post->comments_count)
        <p>{{ $post->comments_count }} comments</p>

    @else
        <p>No comments yet!</p>  
    @endif



@empty
No post found!
@endforelse

@endsection