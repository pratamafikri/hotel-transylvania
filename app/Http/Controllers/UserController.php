<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->withErrors(['User not found.']);
        }

        return view('edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'fullname' => 'required',
            'phone_number' => 'required',
            'nationality' => 'required',
            'no_ktp' => 'required',
            'address' => 'required'
        ]);

        $user->fullname = $request->input('fullname');
        $user->phone_number = $request->input('phone_number');
        $user->nationality = $request->input('nationality');
        $user->no_ktp = $request->input('no_ktp');
        $user->address = $request->input('address');
        $user->save();

        return redirect()->route('dashboard')->with('success', 'User updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
