<div>
    <label class="block text-sm mb-1">Name (optional)</label>
    <input name="name" type="text" value="{{ old('name', $check->name ?? '') }}" placeholder="Homepage" class="w-full border rounded px-3 py-2">
</div>
<div>
    <label class="block text-sm mb-1">Check interval (seconds)</label>
    <input name="interval_seconds" type="number" min="60" max="86400" value="{{ old('interval_seconds', $check->interval_seconds ?? 300) }}" required class="w-full border rounded px-3 py-2">
</div>
<div>
    <label class="block text-sm mb-1">Request timeout (seconds)</label>
    <input name="timeout_seconds" type="number" min="1" max="120" value="{{ old('timeout_seconds', $check->timeout_seconds ?? 10) }}" required class="w-full border rounded px-3 py-2">
</div>
<div>
    <label class="block text-sm mb-1">Method</label>
    <select name="method" class="w-full border rounded px-3 py-2">
        @foreach (['GET', 'HEAD'] as $m)
            <option value="{{ $m }}" @selected(old('method', $check->method ?? 'GET') === $m)>{{ $m }}</option>
        @endforeach
    </select>
</div>
