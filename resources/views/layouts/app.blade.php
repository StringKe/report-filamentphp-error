<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{ $head ?? '' }}

    @filamentStyles
    @vite('resources/css/app.css')
</head>
<body
    class="font-sans min-h-screen bg-gray-50 font-normal text-gray-950 antialiased dark:bg-gray-950 dark:text-white">
{{ $slot }}

@filamentScripts
@vite('resources/js/app.ts')
{{ $footer ?? '' }}
</body>
</html>
