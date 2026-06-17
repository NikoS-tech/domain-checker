@php($up = ($status ?? null) === 'up')
<span class="inline-block px-2 py-0.5 rounded text-xs font-medium {{ is_null($status) ? 'bg-gray-200 text-gray-700' : ($up ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
    {{ $status ? strtoupper($status) : 'PENDING' }}
</span>
