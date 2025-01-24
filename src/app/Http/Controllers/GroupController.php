<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    function index(Request $request)
    {
        $user = User::findOrFail(Auth::id()) ;

        if (request()->user()->role === 'admin')
            $groups = Group::all();
        else{
            $groups = $user->groups;
        }


        return inertia("Groups/index", [
            "groups" => $groups,
            "user" => $user,
        ]);
    }

    function create(){

        $users = User::where(function ($query) {
            $query->where('role', 'farmer')->orWhere('role', 'worker');
        });
        return inertia("Groups/create", [
            "users" => $users->get(),
        ]);
    }

    function store(Request $request){
        $attributes = $request->validate([
            "groupName" => "required | min:3 | max:50",
            "attachedUsers" => "array | nullable",
        ]);

        $group = Group::create([
            'group_name' => $attributes['groupName']
        ]);

        if (!empty($attributes['attachedUsers'])) {
            $userIds = collect($attributes['attachedUsers'])->pluck('id')->toArray();
            $group->users()->attach($userIds);
        }

        return redirect("/");
    }

    function show(string $id){

        $group = Group::findOrFail($id);
        $user = User::findOrFail(Auth::id()) ;

        return inertia("Groups/show", [
            "users" => $group->users,
            "tasks" => $group->tasks,
            "group" => $id,
            "role" => $user->role,
        ]);
    }


    function update(Request $request, string $group)
    {
        $group = Group::findOrFail($group);

        $attributes = $request->validate([
            "groupName" => "required|min:3|max:50",
            "attachedUsers" => "array|nullable",
        ]);

        $group->update([
            'name' => $attributes['groupName'],
        ]);

        if (isset($attributes['attachedUsers'])) {
            $userIds = collect($attributes['attachedUsers'])->pluck('id')->toArray();
            $group->users()->sync($userIds);
        }

        return redirect()->back();
    }

    function destroy(string $group)
    {
        $group = Group::findOrFail($group);

        $group->users()->detach();
        $group->delete();

        return redirect()->back();
    }
}
