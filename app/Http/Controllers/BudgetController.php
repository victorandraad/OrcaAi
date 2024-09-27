<?php

namespace App\Http\Controllers;

use App\Models\Formula;
use App\Models\Material;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function create()
    {
        $formulas = auth()->user()->formulas ?? [];
        $materials = auth()->user()->materials ?? [];
        return view('budget.create', compact('formulas', 'materials'));
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}
