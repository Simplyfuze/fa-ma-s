<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    public function index()
    {
        return inertia('Fields/index', [
            'fields' => Field::all()
        ]);
    }

    public function create()
    {
        return inertia('Fields/create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'field_name' => ['required', 'string', 'min:2', 'max:100'],
            'field_size' => ['required', 'numeric', 'min:1'],
        ]);

        Field::create($attributes);

        return redirect()->route('fields.index')->with('success', 'Field created successfully.');
    }

    public function show(string $field)
    {
        $field = Field::findOrFail($field);
        return inertia('Fields/show', [
            'field' => $field
        ]);
    }

    public function update(Request $request, string $field)
    {
        $field = Field::findOrFail($field);
        $attributes = $request->validate([
            'field_name' => ['required', 'string', 'min:2', 'max:100'],
            'field_size' => ['required', 'numeric', 'min:1'],
        ]);

        $field->update($attributes);

        return redirect()->route('fields.index')->with('success', 'Field updated successfully.');
    }

    public function destroy(string $field)
    {
        $field = Field::findOrFail($field);
        $field->delete();

        return redirect()->route('fields.index')->with('success', 'Field deleted successfully.');
    }
}
