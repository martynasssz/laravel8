@extends('layouts.app')

@section('title', 'Blog Post') 

@section('content')
    @foreach($posts as $key => $post)
        <div>{{ $key }}. {{ $post['title'] }}</div>
    @endforeach

@endsection