@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-4">
    <h1 class="text-lg font-semibold">Domains</h1>
    <a href="{{ route('domains.create') }}" class="bg-gray-900 text-white text-sm rounded px-3 py-2">Add domain</a>
</div>

<div class="bg-white rounded shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-left text-gray-500">
            <tr>
                <th class="px-4 py-2">Domain</th>
                <th class="px-4 py-2">Checks</th>
                <th class="px-4 py-2"></th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse ($domains as $domain)
                <tr>
                    <td class="px-4 py-2 font-medium">
                        <a href="{{ route('domains.show', $domain) }}" class="text-blue-600">{{ $domain->url }}</a>
                    </td>
                    <td class="px-4 py-2 text-gray-500">{{ $domain->checks_count }}</td>
                    <td class="px-4 py-2 text-right whitespace-nowrap">
                        <a href="{{ route('domains.show', $domain) }}" class="text-blue-600">Manage</a>
                        <a href="{{ route('domains.edit', $domain) }}" class="text-blue-600 ml-2">Edit</a>
                        <form method="POST" action="{{ route('domains.destroy', $domain) }}" class="inline" onsubmit="return confirm('Delete this domain and its checks?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 ml-2">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="px-4 py-6 text-center text-gray-500">No domains yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $domains->links() }}</div>
@endsection
