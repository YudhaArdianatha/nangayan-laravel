<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index(){
        return view('register.index');
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'phone_number' => 'required|numeric|digits_between:10,13',
            'gender' => 'required|in:Male,Female',
            'password' => 'required|min:5'
        ]);

        // Generate slug from the name
        $validatedData['slug'] = Str::slug($validatedData['name']);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('/login')->with('success', 'Registration successful. Please login!');
    }
}
