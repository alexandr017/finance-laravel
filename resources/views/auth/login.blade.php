<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="font-sans bg-gray-100 h-screen flex items-center justify-center">

<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf
        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   class="mt-1 p-2 w-full border rounded-md"
                   required autofocus autocomplete="username">
            @error('email')
            <div class="mt-2 text-red-600 text-sm">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
            <input id="password" type="password" name="password"
                   class="mt-1 p-2 w-full border rounded-md"
                   required autocomplete="current-password">
            @error('password')
            <div class="mt-2 text-red-600 text-sm">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" name="remember"
                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
            <label for="remember_me" class="ml-2 text-sm text-gray-600">Remember me</label>
        </div>

        <div class="flex items-center justify-between mt-4">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="text-sm text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Forgot your password?
                </a>
            @endif

            <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded-md">
                Log in
            </button>
        </div>
    </form>
</div>

</body>
</html>
