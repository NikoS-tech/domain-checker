@extends('layouts.app')

@section('content')
<div class="max-w-sm mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-lg font-semibold mb-4">Create account</h1>
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm mb-1">Name</label>
            <input name="name" type="text" value="{{ old('name') }}" required autofocus class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block text-sm mb-1">Email</label>
            <input name="email" type="email" value="{{ old('email') }}" required class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block text-sm mb-1">Password</label>
            <input name="password" type="password" required class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block text-sm mb-1">Confirm password</label>
            <input name="password_confirmation" type="password" required class="w-full border rounded px-3 py-2">
        </div>
        <button class="w-full bg-gray-900 text-white rounded py-2">Register</button>
    </form>
    <p class="text-sm mt-4 text-center">Have an account? <a href="{{ route('login') }}" class="text-blue-600">Sign in</a></p>
</div>
@endsection
