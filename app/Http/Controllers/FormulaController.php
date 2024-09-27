<?php

namespace App\Http\Controllers;

use App\Models\Formula;
use App\Models\Material;
use Illuminate\Http\Request;

class FormulaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = 10; // Número de fórmulas por página

        $formulas = Formula::where('user_id', auth()->id()) // Query the Formula model directly
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->paginate($perPage)
            ->withQueryString();
            
        return view('formulas.index', compact('formulas'));
    }

    public function show($id)
    {
        $formula = auth()->user()->formulas->findOrFail($id);
        return compact('formula');
    }

    public function create()
    {
        $materials = auth()->user()->materials->all();
        return view('formulas.create', compact('materials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'formula' => 'required|string',
        ]);

        // Create a new formula and set the user_id
        $formula = auth()->user()->formulas()->create([
            'name' => $request->input('name'),  
            'formula' => $request->input('formula'),
        ]);
        
        $formula->save(); // Save the formula

        return redirect()->route('formulas.index')->with('success', 'Formula created successfully.');
    }

    public function edit($id)
    {
        $formula = auth()->user()->formulas->findOrFail($id);
        $materials = auth()->user()->materials->all();
        return view('formulas.edit', compact('formula', 'materials'));
    }

    public function update(Request $request, $id)
    {
        $formula = auth()->user()->formulas->findOrFail($id);
        $formula->update($request->all());
        return redirect()->route('formulas.index');
    }

    public function destroy($id)
    {
        $formula = auth()->user()->formulas->findOrFail($id);
        $formula->delete();
        return redirect()->route('formulas.index');
    }
}
