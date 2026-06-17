<div>
    <label class="block text-sm mb-1">Domain URL</label>
    <input name="url" type="text" value="{{ old('url', $domain->url ?? '') }}" placeholder="example.com" required autofocus class="w-full border rounded px-3 py-2">
    <p class="text-xs text-gray-500 mt-1">Example: example.com or https://example.com</p>
</div>
