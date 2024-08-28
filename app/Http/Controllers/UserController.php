<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.users.user', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
{
    $rules = [
        'name' => 'required|max:255',
        'email' => 'required|email:dns|unique:users,email,' . $user->id,
        'phone_number' => 'required|numeric|digits_between:10,13',
        'gender' => 'required|in:Male,Female',
        // Remove the slug rule if you're generating it manually
        // 'slug' => 'required|unique:users,slug,' . $user->id,
    ];

    $validatedData = $request->validate($rules);

    // Generate the slug from the name
    $validatedData['slug'] = strtolower(str_replace(' ', '-', $validatedData['name']));

    // Update the user
    User::where('id', $user->id)->update($validatedData);

    return redirect('/users')->with('success', 'User has been updated!');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/users')->with('success', 'User has been deleted!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(User::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
