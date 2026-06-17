<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Domain Checker') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen">
@auth
    <nav class="bg-white shadow">
        <div class="max-w-5xl mx-auto px-4 h-14 flex items-center justify-between">
            <div class="flex items-center gap-6">
                <a href="{{ route('domains.index') }}" class="font-semibold">Domain Checker</a>
                <a href="{{ route('domains.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Domains</a>
                <a href="{{ route('logs.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Logs</a>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-sm text-gray-600 hover:text-gray-900">Logout</button>
            </form>
        </div>
    </nav>
@endauth

<main class="max-w-5xl mx-auto px-4 py-8">
    @include('partials.flash')
    @yield('content')
</main>

<div id="toasts" class="fixed bottom-4 right-4 space-y-2 z-50"></div>

@auth
    @if (config('broadcasting.default') === 'reverb')
    <script type="module">
        import Echo from 'https://cdn.jsdelivr.net/npm/laravel-echo@1.16.1/+esm';
        import Pusher from 'https://cdn.jsdelivr.net/npm/pusher-js@8.4.0/+esm';

        window.Pusher = Pusher;

        const echo = new Echo({
            broadcaster: 'reverb',
            key: '{{ config('broadcasting.connections.reverb.key') }}',
            wsHost: window.location.hostname,
            wsPort: 8080,
            wssPort: 8080,
            forceTLS: false,
            enabledTransports: ['ws', 'wss'],
            auth: { headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } },
        });

        echo.private('domains.{{ auth()->id() }}').listen('.check.completed', (e) => {
            const up = e.status === 'up';
            const el = document.createElement('div');
            el.className = 'px-4 py-3 rounded shadow text-sm text-white ' + (up ? 'bg-green-600' : 'bg-red-600');
            el.textContent = e.domain + ' [' + e.check + '] — ' + e.status.toUpperCase() + (e.status_code ? ' (' + e.status_code + ')' : '') + ' · new log entry';
            const box = document.getElementById('toasts');
            box.appendChild(el);
            setTimeout(() => el.remove(), 6000);
        });
    </script>
    @endif
@endauth
</body>
</html>
