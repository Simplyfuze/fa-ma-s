<?php

namespace App\Http\Controllers;

use App\Models\Consumable;
use Illuminate\Http\Request;

class ConsumableController extends Controller
{
    public function index()
    {
        return inertia('Consumables/index', [
            'consumables' => Consumable::all()
        ]);
    }

    public function create()
    {
        return inertia('Consumables/create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'consumable_name' => ['required', 'string', 'min:2', 'max:100'],
            'consumable_type' => ['required', 'string', 'min:2', 'max:50'],
        ]);

        Consumable::create($attributes);

        return redirect()->route('consumable.index')->with('success', 'Consumable created successfully.');
    }

    public function show(string $consumable)
    {
        $consumable = Consumable::findOrFail($consumable);
        return inertia('Consumables/show', [
            'consumable' => $consumable
        ]);
    }

    public function update(Request $request, string $consumable)
    {
        $consumable = Consumable::findOrFail($consumable);
        $attributes = $request->validate([
            'consumable_name' => ['required', 'string', 'min:2', 'max:100'],
            'consumable_type' => ['required', 'string', 'min:2', 'max:50'],
        ]);

        $consumable->update($attributes);

        return redirect()->route('consumable.index')->with('success', 'Consumable updated successfully.');
    }

    public function destroy(string $consumable)
    {
        $consumable = Consumable::findOrFail($consumable);

        $consumable->delete();

        return redirect()->route('consumable.index')->with('success', 'Consumable deleted successfully.');
    }
}
