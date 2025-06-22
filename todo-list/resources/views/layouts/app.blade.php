<!DOCTYPE html>
<html>

<head>
    <title>Laravel Project</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/alpinejs@3.14.9/dist/cdn.min.js" defer></script>

    {{-- blade-formatter-disable --}}
        <style type="text/tailwindcss">
            .btn {
                @apply rounded-md px-2 py-1 text-center text-slate-700 font-medium shadow-sm ring-1 ring-slate-700/10 hover:bg-slate-50
            }

            .link {
                @apply font-medium text-gray-700 underline decoration-pink-500
            }

            label {
                @apply block uppercase text-slate-700 mb-2
            }

            input,textarea {
               @apply shadow-sm appearance-none border w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none
            }

            .error {
                @apply text-red-500 text-sm
            }

        </style>
        {{-- blade-formatter-enable --}}
    @yield('styles')
</head>

<body class="container mx-auto mt-10 mb-10 max-w-lg">
    <h1 class="mb-4 text-2xl">
        @yield('title')
    </h1>
    <div x-data="{ flash: true }">
        @if (session()->has('success'))
        {{-- <div>{{ session('success') }}</div> --}}
        <div x-show="flash"
            class="relative mb-10 rounded border border-green-400 bg-green-100 px-4 py-3 text-lg text-green-700"
            role="alert">
            <strong class="font-bold">Success!</strong>
            <div>{{ session('success') }}</div>
            <span class="absolute top-0 right-0 px-4 py-3 cursor-pointer" @click="flash=false">&times;</span>
        </div>
        @endif
        @yield('content')
    </div>
</body>

</html>
