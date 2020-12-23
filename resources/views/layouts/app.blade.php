<!DOCTYPE html>
<html lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Laravel App - @yield('title')</title>

<head> 


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