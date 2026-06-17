@extends('layouts.app')

@section('content')
<div class="max-w-md bg-white p-6 rounded shadow">
    <h1 class="text-lg font-semibold mb-4">Add domain</h1>
    <form method="POST" action="{{ route('domains.store') }}" class="space-y-4">
        @csrf
        @include('domains.form')
        <div class="flex gap-2">
            <button class="bg-gray-900 text-white rounded px-4 py-2 text-sm">Save</button>
            <a href="{{ route('domains.index') }}" class="px-4 py-2 text-sm">Cancel</a>
        </div>
    </form>
</div>
@endsection
