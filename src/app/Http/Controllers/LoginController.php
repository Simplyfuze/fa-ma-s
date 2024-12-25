<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //

    public function index(){
        return inertia('login');
    }

    public function authenticate(Request $request){


    }



}
