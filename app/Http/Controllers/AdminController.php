<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('layouts.admin');
    }

    public function user()
    {
        $users = User::all();
        return view('admin.user', compact('users'));
    }

    public function deleteUser($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return redirect()->back()->with('success', 'User deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'User not found.');
        }
    }

    public function userEdit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user_edit', compact('user'));
    }

    public function userUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validate form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
        ]);

        // Update user information
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        if ($validatedData['password']) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function userShow($id)
    {
        $user = User::findOrFail($id);
        $todos = $user->todos;

        return view('admin.user_show', compact('user', 'todos'));
    }
}
