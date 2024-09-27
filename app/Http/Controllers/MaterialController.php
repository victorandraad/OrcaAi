<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = 10; // Número de materiais por página

        $materials = Material::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->paginate($perPage)
            ->withQueryString();

        return view('materials.index', compact('materials'));
    }

    public function create()
    {
        return view('materials.create');
    }

    public function store(Request $request)
    {
        $validUnits = ['metro', 'centímetro', 'polegada', 'unidade'];

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'unit' => 'required|in:' . implode(',', $validUnits),
        ]);

        $material = new Material();
        $material->name = $request->name;
        $material->price = $request->price;
        $material->unit = $request->unit;
        $material->save();

        return redirect()->route('materials.index');
    }

    public function edit(Material $material)
    {
        return view('materials.edit', compact('material'));
    }

    public function update(Request $request, Material $material)
    {
        $validUnits = ['metro', 'centímetro', 'polegada', 'unidade'];

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'unit' => 'required|in:' . implode(',', $validUnits),
        ]);

        $material->name = $request->name;
        $material->price = $request->price;
        $material->unit = $request->unit;
        $material->save();

        return redirect()->route('materials.index');
    }

    public function destroy(Material $material)
    {
        $material->delete();
        return redirect()->route('materials.index');
    }
}
