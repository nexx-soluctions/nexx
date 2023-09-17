<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @hasSection('title')

            <title>@yield('title') - {{ config('app.name') }}</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif
		<link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <body>
        @yield('body')
    </body>

    @livewireScripts

    <script>
        document.addEventListener('livewire:load', function () {
            console.log(this.$wire.foo);
        });
    </script>
</html>