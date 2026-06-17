@extends('layouts.app')

@section('content')
<div class="max-w-md bg-white p-6 rounded shadow">
    <h1 class="text-lg font-semibold mb-4">Add check &mdash; {{ $domain->url }}</h1>
    <form method="POST" action="{{ route('domains.checks.store', $domain) }}" class="space-y-4">
        @csrf
        @include('checks.form')
        <div class="flex gap-2">
            <button class="bg-gray-900 text-white rounded px-4 py-2 text-sm">Save</button>
            <a href="{{ route('domains.show', $domain) }}" class="px-4 py-2 text-sm">Cancel</a>
        </div>
    </form>
</div>
@endsection
