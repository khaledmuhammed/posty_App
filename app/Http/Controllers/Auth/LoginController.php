<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function store(Request $request)
    {

        // validation
        $this->validate($request, [
            'email' =>'required|email',
            'password' =>'required',
        ]);

        // or: $credentials = [
        //     'username' => $request['username'],
        //     'password' => $request['password'],
        // ];
        //    Auth::attempt($credentials)
        if(!Auth::attempt($request->only('email','password'), $request->remember)){
            return back()->with('status', 'Invalid login details');
        }

        return redirect()->route('dashboard');
    }
}
