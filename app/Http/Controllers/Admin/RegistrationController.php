<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    /**
     * Show all registrations
     */
    public function index()
    {
        $registrations = Registration::with('user')->get();
        return view('admin.registrations.index', compact('registrations'));
    }

    /**
     * Show registration detail
     */
    public function show(Registration $registration)
    {
        return view('admin.registrations.show', compact('registration'));
    }

    /**
     * Show edit form
     */
    public function edit(Registration $registration)
    {
        return view('admin.registrations.edit', compact('registration'));
    }

    /**
     * Update registration
     */
    public function update(Request $request, Registration $registration)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,approved,rejected'],
            'admin_notes' => ['nullable', 'string'],
        ]);

        $registration->update($validated);
        return redirect('/admin/registrations')->with('success', 'Data pendaftaran berhasil diperbarui');
    }

    /**
     * Delete registration
     */
    public function destroy(Registration $registration)
    {
        $registration->delete();
        return redirect('/admin/registrations')->with('success', 'Data pendaftaran berhasil dihapus');
    }

    /**
     * Show admin dashboard
     */
    public function dashboard()
    {
        $totalUsers = \App\Models\User::count();
        $totalRegistrations = Registration::count();
        $approvedRegistrations = Registration::where('status', 'approved')->count();
        $pendingRegistrations = Registration::where('status', 'pending')->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalRegistrations',
            'approvedRegistrations',
            'pendingRegistrations'
        ));
    }
}
