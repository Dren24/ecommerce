<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'hiii' }}</title>  
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles                                                                                         
    </head>
    <body class="bg-gray-100 min-h-screen dark:bg-gray-900">
        <main>
        {{ $slot }}
        @livewireScripts
        </main>
    </body>
</html>
