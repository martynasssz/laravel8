@extends ('layouts.app')

@section('title', 'Update the post')

@section('content')
{{-- ['post' => $post->id])  when we do update we need to know id of model --}}
<form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST">
    @csrf
    {{-- leave mine metodt post, but for update addtionally add @method('PUT') --}}
    @method('PUT') 
    @include ('posts.partials.form')
    <div><input type="submit" value="Update"></div>
</form>

@endsection