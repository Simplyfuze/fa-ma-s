<?php

namespace App\Http\Middleware;


use Inertia\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShareUserData extends Middleware {
	public function share(Request $request) {
		return array_merge(parent::share($request), ['auth' => ['user' => Auth::user(),],]);
	}
}
