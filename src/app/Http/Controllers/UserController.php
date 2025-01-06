<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Users/index', [
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Users/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate and store the newly created resource

        $attributes = $request->validate([
            'first_name' => ['required', 'string', 'min:2', 'max:100'],
            'last_name' => ['required', 'string', 'min:2', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'string', 'min:2', 'max:30', 'in:farmer,worker'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create($attributes);

        return redirect()->route('users.index')->with('success', 'User created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        return inertia('Users/show', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified user.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $attributes = $request->validate([
            'first_name' => ['required', 'string', 'min:2', 'max:100'],
            'last_name' => ['required', 'string', 'min:2', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'role' => ['required', 'string', 'min:2', 'max:30', 'in:farmer,worker'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        try {
            $user->update($attributes);
        } catch (QueryException $e) {
            return back()->withErrors(['email' => 'Email already taken']);
        }


        return redirect()->route('users.index')->with('success', 'User created successfully.');

    }

    /**
     * Remove the specified user.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->tasks()->detach();
        $user->groups()->detach();

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');


    }
}
