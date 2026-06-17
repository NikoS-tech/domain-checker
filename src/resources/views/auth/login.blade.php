@extends('layouts.app')

@section('content')
<div class="max-w-sm mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-lg font-semibold mb-4">Sign in</h1>
    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm mb-1">Email</label>
            <input name="email" type="email" value="{{ old('email') }}" required autofocus class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block text-sm mb-1">Password</label>
            <input name="password" type="password" required class="w-full border rounded px-3 py-2">
        </div>
        <label class="flex items-center gap-2 text-sm">
            <input type="checkbox" name="remember"> Remember me
        </label>
        <button class="w-full bg-gray-900 text-white rounded py-2">Sign in</button>
    </form>
    <p class="text-sm mt-4 text-center">No account? <a href="{{ route('register') }}" class="text-blue-600">Register</a></p>
</div>
@endsection
