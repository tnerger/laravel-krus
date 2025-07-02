<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel job Board</title>



    <!-- Styles / Scripts -->
    {{-- @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot'))) --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- @else --}}
        <style></style>
    {{-- @endif --}}
</head>

<body>
    <div class="text-4xl mt-4 font-bold text-gray-900">This should be a big text</div>
</body>

</html>
