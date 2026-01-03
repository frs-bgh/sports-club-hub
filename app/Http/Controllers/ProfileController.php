<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // members directory (public, but hides admins for visitors)
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $usersQuery = User::query()
            ->select(['id', 'name', 'email', 'username', 'profile_photo_path', 'is_admin', 'birthday'])
            ->orderBy('name');

        // visitors should not see admin accounts in the members list
        $isAdminViewer = auth()->check() && auth()->user()->is_admin;
        if (!$isAdminViewer) {
            $usersQuery->where('is_admin', false);
        }

        if ($q !== '') {
            $usersQuery->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('username', 'like', "%{$q}%");
            });
        }

        $users = $usersQuery->paginate(12)->withQueryString();

        return view('profiles.index', [
            'users' => $users,
            'q' => $q,
            'isAdminViewer' => $isAdminViewer,
        ]);
    }

    // public profile
    public function show(User $user)
    {
        return view('profiles.show', ['user' => $user]);
    }

    // edit own profile (must be logged in)
    public function edit(Request $request)
    {
        return view('profiles.edit', ['user' => $request->user()]);
    }

    // update own profile (must be logged in)
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'username' => ['nullable', 'string', 'max:50'],
            'birthday' => ['nullable', 'date'],
            'about_me' => ['nullable', 'string', 'max:1000'],
            'profile_photo' => ['nullable', 'image', 'max:2048'], // 2MB
        ]);

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $validated['profile_photo_path'] = $path;
        }

        $user->update($validated);

        return redirect()
            ->route('profiles.show', $user)
            ->with('success', 'profile updated');
    }
}
