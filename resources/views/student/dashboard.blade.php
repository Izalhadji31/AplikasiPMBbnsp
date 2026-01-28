@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h2>Dashboard Calon Mahasiswa</h2>
    <p class="text-muted">Selamat datang, {{ auth()->user()->name }}!</p>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row">
    @if($registration)
        <div class="col-md-12">
            <div class="alert alert-info">
                <h5>Status Pendaftaran Anda</h5>
                @if($registration->status == 'approved')
                    <p class="mb-0"><span class="badge bg-success">Disetujui</span> - Selamat! Pendaftaran Anda telah diterima.</p>
                @elseif($registration->status == 'rejected')
                    <p class="mb-0"><span class="badge bg-danger">Ditolak</span> - Maaf, pendaftaran Anda belum dapat diterima.</p>
                @else
                    <p class="mb-0"><span class="badge bg-warning">Menunggu</span> - Pendaftaran Anda sedang dalam proses review.</p>
                @endif
            </div>
        </div>
    @else
        <div class="col-md-12">
            <div class="alert alert-warning">
                <h5>Belum Melakukan Pendaftaran</h5>
                <p class="mb-0">Silakan isi formulir pendaftaran untuk melanjutkan proses masuk ke institusi kami.</p>
            </div>
        </div>
    @endif
</div>

<div class="row mt-3">
    <div class="col-md-12">
        <div class="btn-group" role="group">
            <a href="{{ route('student.registration.create') }}" class="btn btn-primary">{{ $registration ? 'Edit' : 'Mulai' }} Pendaftaran</a>
            @if($registration)
                <a href="{{ route('student.registration.show') }}" class="btn btn-info">Lihat Detail Pendaftaran</a>
            @endif
        </div>
    </div>
</div>

@if($registration)
    <div class="card mt-4">
        <div class="card-header bg-light">
            <h5>Informasi Pendaftaran Terbaru</h5>
        </div>
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $registration->full_name }}</p>
            <p><strong>Email:</strong> {{ $registration->email }}</p>
            <p><strong>Tanggal Pendaftaran:</strong> {{ $registration->created_at->format('d M Y H:i') }}</p>
            @if($registration->admin_notes)
                <div class="alert alert-info mt-3">
                    <strong>Catatan dari Admin:</strong><br>
                    {{ $registration->admin_notes }}
                </div>
            @endif
        </div>
    </div>
@endif
@endsection
