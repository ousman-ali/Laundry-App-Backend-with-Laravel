<?php

namespace App\Http\Controllers;
use App\Models\Inventory;

use Illuminate\Http\Request;

class InventoryController extends Controller
{
     /**
     * Display a listing of the inventory materials.
     */
    public function index()
    {
        return response()->json(Inventory::all());
    }

    /**
     * Store a newly created inventory material in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'unit_price' => 'required|numeric|min:0',
        ]);

        $material = Inventory::create($validated);
        return response()->json($material, 201);
    }

    /**
     * Display the specified inventory material.
     */
    public function show($id)
    {
        $material = Inventory::findOrFail($id);
        return response()->json($material);
    }

    /**
     * Update the specified inventory material in storage.
     */
    public function update(Request $request, $id)
    {
        $material = Inventory::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'stock' => 'sometimes|required|integer|min:0',
            'min_stock' => 'sometimes|required|integer|min:0',
            'unit' => 'sometimes|required|string|max:50',
            'unit_price' => 'sometimes|required|numeric|min:0',
        ]);

        $material->update($validated);
        return response()->json($material);
    }

    /**
     * Remove the specified inventory material from storage.
     */
    public function destroy($id)
    {
        $material = Inventory::findOrFail($id);
        $material->delete();

        return response()->json(['message' => 'Inventory material deleted successfully.']);
    }
}
