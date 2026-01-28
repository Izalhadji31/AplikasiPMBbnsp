<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show all users
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show create user form
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store new user
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
            'role' => ['required', 'in:admin,student'],
        ]);

        User::create($validated);
        return redirect('/admin/users')->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Show edit user form
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update user
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'role' => ['required', 'in:admin,student'],
        ]);

        if ($request->filled('password')) {
            $validated['password'] = $request->validate([
                'password' => ['required', 'min:6', 'confirmed'],
            ])['password'];
        }

        $user->update($validated);
        return redirect('/admin/users')->with('success', 'User berhasil diperbarui');
    }

    /**
     * Delete user
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/admin/users')->with('success', 'User berhasil dihapus');
    }
}
