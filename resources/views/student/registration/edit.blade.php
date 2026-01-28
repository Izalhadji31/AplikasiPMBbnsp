@extends('layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('student.dashboard') }}" class="btn btn-secondary mb-2">← Kembali</a>
    <h2>Edit Pendaftaran</h2>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('student.registration.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <h5 class="mb-3">Data Pribadi</h5>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="full_name" class="form-label">Nama Lengkap *</label>
                        <input type="text" class="form-control @error('full_name') is-invalid @enderror" 
                               id="full_name" name="full_name" value="{{ old('full_name', $registration->full_name) }}" required>
                        @error('full_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="phone" class="form-label">No Telepon *</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                               id="phone" name="phone" value="{{ old('phone', $registration->phone) }}" required>
                        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Alamat *</label>
                <textarea class="form-control @error('address') is-invalid @enderror" 
                          id="address" name="address" rows="2" required>{{ old('address', $registration->address) }}</textarea>
                @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="birth_place" class="form-label">Tempat Lahir *</label>
                        <input type="text" class="form-control @error('birth_place') is-invalid @enderror" 
                               id="birth_place" name="birth_place" value="{{ old('birth_place', $registration->birth_place) }}" required>
                        @error('birth_place')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="birth_date" class="form-label">Tanggal Lahir *</label>
                        <input type="date" class="form-control @error('birth_date') is-invalid @enderror" 
                               id="birth_date" name="birth_date" value="{{ old('birth_date', $registration->birth_date) }}" required>
                        @error('birth_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label">Jenis Kelamin *</label>
                <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="male" {{ (old('gender', $registration->gender) == 'male') ? 'selected' : '' }}>Laki-laki</option>
                    <option value="female" {{ (old('gender', $registration->gender) == 'female') ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <hr>
            <h5 class="mb-3">Data Pendidikan</h5>

            <div class="mb-3">
                <label for="education_background" class="form-label">Latar Belakang Pendidikan *</label>
                <input type="text" class="form-control @error('education_background') is-invalid @enderror" 
                       id="education_background" name="education_background" value="{{ old('education_background', $registration->education_background) }}" required>
                @error('education_background')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="school_name" class="form-label">Nama Sekolah/Perguruan Tinggi *</label>
                <input type="text" class="form-control @error('school_name') is-invalid @enderror" 
                       id="school_name" name="school_name" value="{{ old('school_name', $registration->school_name) }}" required>
                @error('school_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="gpa" class="form-label">IPK / Nilai Rata-rata (0-4) *</label>
                <input type="number" step="0.01" min="0" max="4" class="form-control @error('gpa') is-invalid @enderror" 
                       id="gpa" name="gpa" value="{{ old('gpa', $registration->gpa) }}" required>
                @error('gpa')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <hr>
            <h5 class="mb-3">Data Tambahan</h5>

            <div class="mb-3">
                <label for="motivation" class="form-label">Motivasi Mendaftar *</label>
                <textarea class="form-control @error('motivation') is-invalid @enderror" 
                          id="motivation" name="motivation" rows="5" required>{{ old('motivation', $registration->motivation) }}</textarea>
                @error('motivation')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="attachment" class="form-label">Lampiran (PDF, DOC, DOCX max 5MB)</label>
                <input type="file" class="form-control @error('attachment') is-invalid @enderror" 
                       id="attachment" name="attachment" accept=".pdf,.doc,.docx">
                @error('attachment')<div class="invalid-feedback">{{ $message }}</div>@enderror
                @if($registration->attachment_path)
                    <small class="text-muted">File saat ini: <a href="{{ asset('storage/' . $registration->attachment_path) }}" target="_blank">Lihat File</a></small>
                @endif
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Perbarui Pendaftaran</button>
                <a href="{{ route('student.dashboard') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
