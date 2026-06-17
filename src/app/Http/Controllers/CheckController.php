<?php

namespace App\Http\Controllers;

use App\Models\Check;
use App\Models\Domain;
use App\Services\CheckRunner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckController extends Controller
{
    public function create(Domain $domain): View
    {
        $this->authorize('create', [Check::class, $domain]);

        return view('checks.create', compact('domain'));
    }

    public function store(Request $request, Domain $domain): RedirectResponse
    {
        $this->authorize('create', [Check::class, $domain]);
        $domain->checks()->create($this->validateCheck($request));

        return redirect()->route('domains.show', $domain)->with('status', 'Check created.');
    }

    public function edit(Check $check): View
    {
        $this->authorize('update', $check);

        return view('checks.edit', compact('check'));
    }

    public function update(Request $request, Check $check): RedirectResponse
    {
        $this->authorize('update', $check);
        $check->update($this->validateCheck($request));

        return redirect()->route('domains.show', $check->domain)->with('status', 'Check updated.');
    }

    public function destroy(Check $check): RedirectResponse
    {
        $this->authorize('delete', $check);
        $domain = $check->domain;
        $check->delete();

        return redirect()->route('domains.show', $domain)->with('status', 'Check deleted.');
    }

    public function run(Check $check, CheckRunner $runner): RedirectResponse
    {
        $this->authorize('run', $check);
        $result = $runner->run($check);

        return back()->with('status', 'Check executed: ' . strtoupper($result->status) . ($result->status_code ? ' (' . $result->status_code . ')' : ''));
    }

    private function validateCheck(Request $request): array
    {
        return $request->validate([
            'name'             => ['nullable', 'string', 'max:255'],
            'interval_seconds' => ['required', 'integer', 'min:60', 'max:86400'],
            'timeout_seconds'  => ['required', 'integer', 'min:1', 'max:120'],
            'method'           => ['required', 'in:GET,HEAD'],
        ]);
    }
}
