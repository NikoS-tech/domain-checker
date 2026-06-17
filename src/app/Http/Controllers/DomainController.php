<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class DomainController extends Controller
{
    public function index(Request $request): View
    {
        $domains = $request->user()->domains()->withCount('checks')->latest()->paginate(15);

        return view('domains.index', compact('domains'));
    }

    public function create(): View
    {
        return view('domains.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->user()->domains()->create($this->validateDomain($request));

        return redirect()->route('domains.index')->with('status', 'Domain added.');
    }

    public function show(Domain $domain): View
    {
        $this->authorize('view', $domain);
        $checks = $domain->checks()->with('latestResult')->latest()->get();

        return view('domains.show', compact('domain', 'checks'));
    }

    public function edit(Domain $domain): View
    {
        $this->authorize('update', $domain);

        return view('domains.edit', compact('domain'));
    }

    public function update(Request $request, Domain $domain): RedirectResponse
    {
        $this->authorize('update', $domain);
        $domain->update($this->validateDomain($request, $domain));

        return redirect()->route('domains.index')->with('status', 'Domain updated.');
    }

    public function destroy(Domain $domain): RedirectResponse
    {
        $this->authorize('delete', $domain);
        $domain->delete();

        return redirect()->route('domains.index')->with('status', 'Domain deleted.');
    }

    private function validateDomain(Request $request, ?Domain $domain = null): array
    {
        return $request->validate([
            'url' => [
                'required',
                'string',
                'max:255',
                'regex:/^(https?:\/\/)?([a-z0-9-]+\.)+[a-z]{2,}(\/.*)?$/i',
                Rule::unique('domains')->where('user_id', $request->user()->id)->ignore($domain),
            ],
        ]);
    }
}
