<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RegistrationController extends Controller
{
    /**
     * Show registration form
     */
    public function create()
    {
        $existingRegistration = Auth::user()->registration;
        return view('student.registration.create', compact('existingRegistration'));
    }

    /**
     * Store registration
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'birth_place' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'gender' => ['required', 'in:male,female'],
            'education_background' => ['required', 'string'],
            'school_name' => ['required', 'string', 'max:255'],
            'gpa' => ['required', 'numeric', 'min:0', 'max:4'],
            'motivation' => ['required', 'string'],
            'attachment' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ]);

        $user = Auth::user();

        // Handle file upload
        if ($request->hasFile('attachment')) {
            $validated['attachment_path'] = $request->file('attachment')->store('registrations', 'public');
        }

        $validated['user_id'] = $user->id;
        $validated['email'] = $user->email;

        // Delete existing registration if any
        if ($user->registration) {
            $user->registration->delete();
        }

        Registration::create($validated);
        return redirect('/student/dashboard')->with('success', 'Pendaftaran berhasil disimpan');
    }

    /**
     * Show student dashboard
     */
    public function dashboard()
    {
        $user = Auth::user();
        $registration = $user->registration;
        return view('student.dashboard', compact('registration'));
    }

    /**
     * Show registration details
     */
    public function show()
    {
        $registration = Auth::user()->registration;
        if (!$registration) {
            return redirect('/student/registration/create');
        }
        return view('student.registration.show', compact('registration'));
    }

    /**
     * Edit registration
     */
    public function edit()
    {
        $registration = Auth::user()->registration;
        if (!$registration) {
            return redirect('/student/registration/create');
        }
        return view('student.registration.edit', compact('registration'));
    }

    /**
     * Update registration
     */
    public function update(Request $request)
    {
        $registration = Auth::user()->registration;
        if (!$registration) {
            return redirect('/student/registration/create');
        }

        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'birth_place' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'gender' => ['required', 'in:male,female'],
            'education_background' => ['required', 'string'],
            'school_name' => ['required', 'string', 'max:255'],
            'gpa' => ['required', 'numeric', 'min:0', 'max:4'],
            'motivation' => ['required', 'string'],
            'attachment' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ]);

        // Handle file upload
        if ($request->hasFile('attachment')) {
            // Delete old file if exists
            if ($registration->attachment_path) {
                Storage::disk('public')->delete($registration->attachment_path);
            }
            $validated['attachment_path'] = $request->file('attachment')->store('registrations', 'public');
        }

        $registration->update($validated);
        return redirect('/student/dashboard')->with('success', 'Pendaftaran berhasil diperbarui');
    }
}
