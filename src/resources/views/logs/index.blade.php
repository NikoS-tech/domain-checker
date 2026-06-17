@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-4">
    <h1 class="text-lg font-semibold">Logs</h1>
    <form method="GET" action="{{ route('logs.index') }}">
        <select name="domain" onchange="this.form.submit()" class="border rounded px-3 py-2 text-sm">
            <option value="">All domains</option>
            @foreach ($domains as $domain)
                <option value="{{ $domain->id }}" @selected(request('domain') == $domain->id)>{{ $domain->url }}</option>
            @endforeach
        </select>
    </form>
</div>

<div class="bg-white rounded shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-left text-gray-500">
            <tr>
                <th class="px-4 py-2">Date</th>
                <th class="px-4 py-2">Domain</th>
                <th class="px-4 py-2">Check</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Code</th>
                <th class="px-4 py-2">Time</th>
                <th class="px-4 py-2">Error</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse ($results as $result)
                <tr>
                    <td class="px-4 py-2 text-gray-500 whitespace-nowrap">{{ $result->created_at->format('Y-m-d H:i:s') }}</td>
                    <td class="px-4 py-2 font-medium">{{ $result->check->domain->url }}</td>
                    <td class="px-4 py-2">{{ $result->check->label() }}</td>
                    <td class="px-4 py-2">@include('partials.status', ['status' => $result->status])</td>
                    <td class="px-4 py-2">{{ $result->status_code ?? '—' }}</td>
                    <td class="px-4 py-2">{{ $result->response_time !== null ? $result->response_time.' ms' : '—' }}</td>
                    <td class="px-4 py-2 text-red-600 max-w-xs truncate" title="{{ $result->error }}">{{ $result->error }}</td>
                </tr>
            @empty
                <tr><td colspan="7" class="px-4 py-6 text-center text-gray-500">No checks recorded yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $results->links() }}</div>
@endsection
