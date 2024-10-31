<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faculties = User::where('usertype', 'user')->get();
        return view('admin.faculty.index', compact('faculties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required|string|max:15',
            'department' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Store the faculty as a user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'department' => $request->department,
            'password' => Hash::make($request->password),
            'usertype' => 'user', // Faculty usertype set as 'user'
        ]);

        return redirect()->route('admin.faculty.index')->with('success', 'Faculty added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $faculty = User::findOrFail($id);
        return view('admin.faculty.show', compact('faculty'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $faculty = User::findOrFail($id);
        return view('admin.faculty.edit', compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $faculty = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'phone' => 'required|string|max:15',
            'department' => 'required|string|max:255',
        ]);

        // Update faculty details
        $faculty->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'department' => $request->department,
        ]);

        return redirect()->route('admin.faculty.index')->with('success', 'Faculty updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $faculty = User::findOrFail($id);
        $faculty->delete();

        return redirect()->route('admin.faculty.index')->with('success', 'Faculty deleted successfully!');
    }
}