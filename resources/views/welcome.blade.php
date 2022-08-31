<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="{{ asset('css/app.css')}}">
        <!-- Fonts -->
        
    </head>
    <body class="antialiased">
        <ul class="p-10 bg-gray-500 text-white">
            @foreach ($states as $state)
                <li>{{$state->country}}, {{ $state->name }}</li>
            @endforeach
        </ul>
    </body>
</html>
