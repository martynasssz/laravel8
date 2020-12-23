<!DOCTYPE html>
<html lang="en">
    
<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer > </script>
    <title> Laravel App - @yield('title')</title>   

</head>

<body>
    <div>
        @if(session('status'))
            <div style="background: red; color: white">
                {{ session('status') }}
            </div>
        @endif

        @yield('content')
    </div>
</body>

</html>