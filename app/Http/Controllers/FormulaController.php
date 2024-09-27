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

        $formulas = Formula::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->paginate($perPage)
            ->withQueryString();

        return view('formulas.index', compact('formulas'));
    }

    public function create()
    {
        $materials = Material::all();
        return view('formulas.create', compact('materials'));
    }

    public function store(Request $request)
    {
        $allowedOperators = ['+', '-', '*', '/', '%'];
        $formulaPattern = '/^(\{[a-zA-Z0-9_]+\}|\d+(\.\d+)?|' . preg_quote(implode('|', $allowedOperators), '/') . '|\s)+$/';

        $request->validate([
            'name' => 'required',
            'formula' => [
                'required',
                'regex:' . $formulaPattern,
                function ($attribute, $value, $fail) {
                    $variables = [];
                    preg_match_all('/\{([a-zA-Z0-9_]+)\}/', $value, $matches);
                    foreach ($matches[1] as $variable) {
                        if (in_array($variable, $variables)) {
                            $fail('Duplicate variable name: {' . $variable . '}');
                        }
                        $variables[] = $variable;
                    }
                },
            ],
            'materials' => 'required|array',
        ]);

        $formula = new Formula();
        $formula->name = $request->name;
        $formula->formula = $request->formula;
        $formula->save();

        $formula->materials()->sync($request->materials);

        return redirect()->route('formulas.index');
    }

    public function edit($id)
    {
        $formula = Formula::findOrFail($id);
        return view('formulas.edit', compact('formula'));
    }

    public function update(Request $request, $id)
    {
        $formula = Formula::findOrFail($id);
        $formula->update($request->all());
        return redirect()->route('formulas.index');
    }

    public function destroy($id)
    {
        $formula = Formula::findOrFail($id);
        $formula->delete();
        return redirect()->route('formulas.index');
    }
}
