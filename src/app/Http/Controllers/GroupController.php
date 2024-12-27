<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    function index(Request $request)
    {
        //
        return inertia("Groups/index", [
            "groups" => [Group::with('users')->find(request()->user()->id)]
        ]
        );
    }
}
