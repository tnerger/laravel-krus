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

<body class="mx-auto mt-10 max-w-2xl bg-gradient-to-r from-indigo-100 via-sky-100 via-30% to-emerald-100 text-salte-700">
    <nav class="mb-8 flex justify-between text-lg font-medium">
        <ul class="flex space-x-2">
            <li>
                <a href="{{ route('jobs.index') }}">Home</a>
            </li>
        </ul>
        <ul class="flex space-x-2">
            @auth
                <li>
                    {{auth()->user()->name ?? 'No Name'}}
                </li>
                <li>
                    <form action="{{route('auth.destroy')}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>Logout</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('auth.create') }}">Sign in</a></li>
            @endauth
        </ul>
    </nav>
    {{ $slot }}
</body>

</html>
