@extends('layouts.app')

@section('title', 'Blog Post') 

@section('content')


@forelse($posts as $key => $post)
 {{--  @break($key == 2)  //stop loop at key2   --}}
{{--  @continue ($key == 1) //skyp first element and continue with secod element    --}}
@if($loop->even)
<div>{{ $key }}. {{ $post['title'] }}</div>
@else
<div style="background-color: silver">{{ $key }}. {{ $post['title'] }}</div>
@endif
@empty
No post found!
@endforelse

@endsection