<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{

    function index ()
    {
        return inertia('Equipment/index',[
            'equipments' => Equipment::all()
            ]
        );
    }

    function create (){
        return inertia('Equipment/create');
    }

    function store(Request $request)
    {
        $attributes = $request->validate([
            'brand_name' => ['required', 'string', 'min:2', 'max:60'],
            'model_name' => ['required', 'string', 'min:2', 'max:100'],
            'registration_number' => ['nullable', 'string', 'min:8', 'max:12'],
            'year_of_manufacture' => ['required', 'integer', 'digits:4'],
        ]);

        Equipment::create($attributes);

        return redirect()->route('equipments.index')->with('success', 'Equipment created successfully.');
    }


    function show(string $equipment)
    {
        $equipment = Equipment::findOrFail($equipment);

        return inertia('Equipment/show', [
            'equipment' => $equipment
        ]);
    }

    function update(Request $request, string $equipment)
    {
        $equipment = Equipment::findOrFail($equipment);

        $attributes = $request->validate([
            'brand_name' => ['required', 'string', 'min:2', 'max:60'],
            'model_name' => ['required', 'string', 'min:2', 'max:100'],
            'registration_number' => ['nullable', 'string', 'min:8', 'max:12'],
            'year_of_manufacture' => ['required', 'integer', 'digits:4'],
        ]);

        $equipment->update($attributes);

        return redirect()->route('equipments.index')->with('success', 'Equipment updated successfully.');
    }

    function destroy(string $equipment)
    {
        $equipment = Equipment::findOrFail($equipment);

        $equipment->delete();

        return redirect()->route('equipments.index')->with('success', 'Equipment deleted successfully.');
    }
}
