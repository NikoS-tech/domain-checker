@extends('layouts.app')

@section('content')
<div class="max-w-md bg-white p-6 rounded shadow">
    <h1 class="text-lg font-semibold mb-4">Edit check &mdash; {{ $check->domain->url }}</h1>
    <form method="POST" action="{{ route('checks.update', $check) }}" class="space-y-4">
        @csrf
        @method('PUT')
        @include('checks.form')
        <div class="flex gap-2">
            <button class="bg-gray-900 text-white rounded px-4 py-2 text-sm">Update</button>
            <a href="{{ route('domains.show', $check->domain) }}" class="px-4 py-2 text-sm">Cancel</a>
        </div>
    </form>
</div>
@endsection
