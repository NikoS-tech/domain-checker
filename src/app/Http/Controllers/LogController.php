<?php

namespace App\Http\Controllers;

use App\Models\Check;
use App\Models\CheckResult;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LogController extends Controller
{
    public function index(Request $request): View
    {
        $domains = $request->user()->domains()->orderBy('url')->get();
        $checkIds = Check::whereIn('domain_id', $domains->pluck('id'))->pluck('id');

        $results = CheckResult::whereIn('check_id', $checkIds)
            ->when($request->integer('domain'), fn($query, $id) => $query->whereIn('check_id', Check::where('domain_id', $id)->pluck('id')))
            ->with('check.domain')
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('logs.index', compact('results', 'domains'));
    }
}
