<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function register(Request $request) {

        $request->validate([
            'name' => 'required|min:3|string',
            'email' => 'required|email|min:10|unique:users|string',
            'password' => 'required|min:8|string',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password) 
        ]);
        return response($user, 200);

    }


}
