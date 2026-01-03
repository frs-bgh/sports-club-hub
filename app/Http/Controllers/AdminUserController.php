<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id')->get();

        return view('admin.users.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'min:8'],
            'is_admin' => ['nullable'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => $request->boolean('is_admin'),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'user created');
    }

    public function toggleAdmin(User $user)
    {
        // never change the main admin account
        if ($user->email === 'admin@ehb.be') {
            return back()->with('error', 'you cannot change admin@ehb.be');
        }

        // avoid removing your own admin rights
        if ($user->id === auth()->id()) {
            return back()->with('error', 'you cannot change your own admin rights');
        }

        $user->is_admin = !$user->is_admin;
        $user->save();

        return back()->with('success', 'admin role updated');
    }

    public function destroy(User $user)
    {
        // never delete the main admin account
        if ($user->email === 'admin@ehb.be') {
            return back()->with('error', 'you cannot delete admin@ehb.be');
        }

        // optional: avoid deleting yourself
        if ($user->id === auth()->id()) {
            return back()->with('error', 'you cannot delete your own account');
        }

        $user->delete();

        return back()->with('success', 'user deleted');
    }
}
