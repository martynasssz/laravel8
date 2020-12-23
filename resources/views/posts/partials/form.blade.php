{{-- value="'{{ old('title') }} use for keeping value in form field after showing errors --}}
{{-- optional($post)->title  optional helps to access it properties, whether the object is null or not --}}
{{-- ?? null returns null if the value on the left not exits --}}

<div><input type="text" name="title" value="{{ old('title', optional($post ?? null)->title) }}"></div>
{{-- error message only for title --}}
@error('title') 
    <div>{{ $message }}</div>
@enderror
<div><textarea name ="content">{{ old('content', optional($post ?? null)->content) }}</textarea></div>
{{-- errors massages for all fields --}}
@if($errors->any())
    <div>
        <ul>
            @foreach($errors->all() as $error)
                 <li>{{ $error }}</li> 
            @endforeach
        </ul>
    </div>
@endif