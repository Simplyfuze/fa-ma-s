<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    //
    public function store(Request $request){


        $attributes = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(!Auth::attempt($attributes)){
            return back()->withErrors([
                'wrongCredentials' => 'Wrong email or password',
            ]);
        }

        request()->session()->regenerate();

        return redirect()->intended();
    }



}
