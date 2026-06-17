@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-4">
    <div>
        <a href="{{ route('domains.index') }}" class="text-sm text-blue-600">&larr; Domains</a>
        <h1 class="text-lg font-semibold">{{ $domain->url }}</h1>
    </div>
    <a href="{{ route('domains.checks.create', $domain) }}" class="bg-gray-900 text-white text-sm rounded px-3 py-2">Add check</a>
</div>

<div class="bg-white rounded shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-left text-gray-500">
            <tr>
                <th class="px-4 py-2">Check</th>
                <th class="px-4 py-2">Method</th>
                <th class="px-4 py-2">Interval</th>
                <th class="px-4 py-2">Timeout</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Code</th>
                <th class="px-4 py-2">Last run</th>
                <th class="px-4 py-2"></th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse ($checks as $check)
                <tr>
                    <td class="px-4 py-2 font-medium">{{ $check->label() }}</td>
                    <td class="px-4 py-2">{{ $check->method }}</td>
                    <td class="px-4 py-2 text-gray-500">{{ $check->interval_seconds }}s</td>
                    <td class="px-4 py-2 text-gray-500">{{ $check->timeout_seconds }}s</td>
                    <td class="px-4 py-2">@include('partials.status', ['status' => $check->latestResult?->status])</td>
                    <td class="px-4 py-2">{{ $check->latestResult?->status_code ?? '—' }}</td>
                    <td class="px-4 py-2 text-gray-500">{{ $check->last_run_at?->diffForHumans() ?? 'never' }}</td>
                    <td class="px-4 py-2 text-right whitespace-nowrap">
                        <form method="POST" action="{{ route('checks.run', $check) }}" class="inline">
                            @csrf
                            <button class="text-green-700">Run</button>
                        </form>
                        <a href="{{ route('checks.edit', $check) }}" class="text-blue-600 ml-2">Edit</a>
                        <form method="POST" action="{{ route('checks.destroy', $check) }}" class="inline" onsubmit="return confirm('Delete this check?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 ml-2">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="px-4 py-6 text-center text-gray-500">No checks yet. Add one to start monitoring.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
