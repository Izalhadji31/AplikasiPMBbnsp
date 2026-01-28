@extends('layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('student.dashboard') }}" class="btn btn-secondary mb-2">← Kembali</a>
    <h2>Formulir Isian Pendaftaran Mahasiswa Baru BNSP</h2>
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
        <form method="POST" action="{{ route('student.registration.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- DATA PRIBADI -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">DATA PRIBADI</h5>
                </div>
                <div class="card-body">
                    <!-- 1. Nama Lengkap -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">1. Nama Lengkap *</label>
                        <input type="text" class="form-control @error('full_name') is-invalid @enderror" 
                               name="full_name" value="{{ old('full_name', $existingRegistration->full_name ?? '') }}" 
                               placeholder="Isikan nama lengkap" required style="min-height: 60px;">
                        @error('full_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- 2. Alamat KTP & Saat Ini -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">2. Alamat</label>
                        
                        <label class="form-label mt-2">Alamat Lengkap Saat Ini *</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" 
                                  name="address" rows="2" placeholder="Isikan alamat lengkap saat ini" 
                                  required>{{ old('address', $existingRegistration->address ?? '') }}</textarea>
                        @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror

                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label class="form-label">Kecamatan</label>
                                <input type="text" class="form-control" placeholder="Kecamatan">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Kabupaten/Kota</label>
                                <input type="text" class="form-control" placeholder="Kabupaten/Kota">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Provinsi</label>
                                <input type="text" class="form-control" placeholder="Provinsi">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="form-label">Nomor Telepon *</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                       name="phone" value="{{ old('phone', $existingRegistration->phone ?? '') }}" 
                                       placeholder="Nomor telepon" required>
                                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email *</label>
                                <input type="email" class="form-control" value="{{ auth()->user()->email }}" disabled>
                                <small class="text-muted">Email anda: {{ auth()->user()->email }}</small>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Tanggal Lahir -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">3. Tanggal Lahir (Hari/Bulan/Tahun) *</label>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Tempat Lahir *</label>
                                <input type="text" class="form-control @error('birth_place') is-invalid @enderror" 
                                       name="birth_place" value="{{ old('birth_place', $existingRegistration->birth_place ?? '') }}" 
                                       placeholder="Tempat lahir" required>
                                @error('birth_place')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-8">
                                <label class="form-label">Tanggal Lahir *</label>
                                <input type="date" class="form-control @error('birth_date') is-invalid @enderror" 
                                       name="birth_date" value="{{ old('birth_date', $existingRegistration->birth_date ?? '') }}" required>
                                @error('birth_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <!-- 4. Jenis Kelamin -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">4. Jenis Kelamin *</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender_male" 
                                       value="male" {{ (old('gender', $existingRegistration->gender ?? '') == 'male') ? 'checked' : '' }} required>
                                <label class="form-check-label" for="gender_male">Pria</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender_female" 
                                       value="female" {{ (old('gender', $existingRegistration->gender ?? '') == 'female') ? 'checked' : '' }}>
                                <label class="form-check-label" for="gender_female">Wanita</label>
                            </div>
                        </div>
                        @error('gender')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <!-- DATA PENDIDIKAN -->
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">DATA PENDIDIKAN</h5>
                </div>
                <div class="card-body">
                    <!-- 5. Latar Belakang Pendidikan -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">5. Latar Belakang Pendidikan *</label>
                        <select class="form-control @error('education_background') is-invalid @enderror" 
                                name="education_background" required>
                            <option value="">-- Pilih --</option>
                            <option value="SMA" {{ (old('education_background', $existingRegistration->education_background ?? '') == 'SMA') ? 'selected' : '' }}>SMA</option>
                            <option value="SMK" {{ (old('education_background', $existingRegistration->education_background ?? '') == 'SMK') ? 'selected' : '' }}>SMK</option>
                            <option value="D1" {{ (old('education_background', $existingRegistration->education_background ?? '') == 'D1') ? 'selected' : '' }}>D1</option>
                            <option value="D2" {{ (old('education_background', $existingRegistration->education_background ?? '') == 'D2') ? 'selected' : '' }}>D2</option>
                            <option value="D3" {{ (old('education_background', $existingRegistration->education_background ?? '') == 'D3') ? 'selected' : '' }}>D3</option>
                            <option value="S1" {{ (old('education_background', $existingRegistration->education_background ?? '') == 'S1') ? 'selected' : '' }}>S1</option>
                        </select>
                        @error('education_background')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- 6. Nama Sekolah -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">6. Nama Sekolah/Perguruan Tinggi *</label>
                        <input type="text" class="form-control @error('school_name') is-invalid @enderror" 
                               name="school_name" value="{{ old('school_name', $existingRegistration->school_name ?? '') }}" 
                               placeholder="Nama sekolah/perguruan tinggi" required>
                        @error('school_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- 7. IPK / Nilai Rata-rata -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">7. IPK / Nilai Rata-rata (0-4) *</label>
                        <input type="number" step="0.01" min="0" max="4" class="form-control @error('gpa') is-invalid @enderror" 
                               name="gpa" value="{{ old('gpa', $existingRegistration->gpa ?? '') }}" 
                               placeholder="Isikan nilai dengan format 0.00" required>
                        @error('gpa')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <!-- MOTIVASI & LAMPIRAN -->
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">MOTIVASI & DOKUMEN</h5>
                </div>
                <div class="card-body">
                    <!-- 8. Motivasi -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">8. Motivasi Mendaftar *</label>
                        <textarea class="form-control @error('motivation') is-invalid @enderror" 
                                  name="motivation" rows="5" placeholder="Jelaskan motivasi anda mendaftar" 
                                  required>{{ old('motivation', $existingRegistration->motivation ?? '') }}</textarea>
                        @error('motivation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- 9. Lampiran -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">9. Lampiran Dokumen</label>
                        <div class="alert alert-info small">
                            <strong>Format yang diterima:</strong> PDF, DOC, DOCX (maksimal 5MB)
                        </div>
                        <input type="file" class="form-control @error('attachment') is-invalid @enderror" 
                               name="attachment" accept=".pdf,.doc,.docx">
                        @error('attachment')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        @if($existingRegistration && $existingRegistration->attachment_path)
                            <div class="mt-2">
                                <small class="text-muted">File saat ini: 
                                    <a href="{{ asset('storage/' . $existingRegistration->attachment_path) }}" target="_blank" class="badge bg-success">
                                        <i class="fas fa-file"></i> Lihat File
                                    </a>
                                </small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- TOMBOL AKSI -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save"></i> {{ $existingRegistration ? 'Perbarui Pendaftaran' : 'Daftar Sekarang' }}
                </button>
                <a href="{{ route('student.dashboard') }}" class="btn btn-secondary btn-lg">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
