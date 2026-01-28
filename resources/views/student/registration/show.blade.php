@extends('layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('student.dashboard') }}" class="btn btn-secondary mb-2">← Kembali</a>
    <h2>Detail Pendaftaran Anda</h2>
</div>

<div class="card">
    <div class="card-header bg-light">
        <h5>Data Pribadi</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Nama Lengkap:</strong> {{ $registration->full_name }}</p>
                <p><strong>Email:</strong> {{ $registration->email }}</p>
                <p><strong>No Telepon:</strong> {{ $registration->phone }}</p>
                <p><strong>Tempat Lahir:</strong> {{ $registration->birth_place }}</p>
                <p><strong>Tanggal Lahir:</strong> {{ $registration->birth_date->format('d M Y') }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Jenis Kelamin:</strong> {{ $registration->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</p>
                <p><strong>Alamat:</strong> {{ $registration->address }}</p>
                <p><strong>Pendidikan:</strong> {{ $registration->education_background }}</p>
                <p><strong>Nama Sekolah:</strong> {{ $registration->school_name }}</p>
                <p><strong>IPK:</strong> {{ $registration->gpa }}</p>
            </div>
        </div>
    </div>
</div>

<div class="card mt-3">
    <div class="card-header bg-light">
        <h5>Motivasi</h5>
    </div>
    <div class="card-body">
        {{ $registration->motivation }}
    </div>
</div>

@if($registration->attachment_path)
    <div class="card mt-3">
        <div class="card-header bg-light">
            <h5>Lampiran</h5>
        </div>
        <div class="card-body">
            <a href="{{ asset('storage/' . $registration->attachment_path) }}" target="_blank" class="btn btn-primary">
                Download Lampiran
            </a>
        </div>
    </div>
@endif

<div class="card mt-3">
    <div class="card-header bg-light">
        <h5>Status Pendaftaran</h5>
    </div>
    <div class="card-body">
        <p><strong>Status:</strong>
            @if($registration->status == 'approved')
                <span class="badge bg-success">Disetujui</span>
            @elseif($registration->status == 'rejected')
                <span class="badge bg-danger">Ditolak</span>
            @else
                <span class="badge bg-warning">Menunggu</span>
            @endif
        </p>
        <p><strong>Tanggal Pendaftaran:</strong> {{ $registration->created_at->format('d M Y H:i') }}</p>
        <p><strong>Terakhir Diperbarui:</strong> {{ $registration->updated_at->format('d M Y H:i') }}</p>
        @if($registration->admin_notes)
            <div class="alert alert-info mt-3">
                <strong>Catatan dari Admin:</strong><br>
                {{ $registration->admin_notes }}
            </div>
        @endif
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('student.registration.edit') }}" class="btn btn-warning">Edit Pendaftaran</a>
</div>
@endsection
