@extends('layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.registrations.index') }}" class="btn btn-secondary mb-2">← Kembali</a>
    <h2>Edit Status Pendaftaran</h2>
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
        <p class="mb-3">
            <strong>Nama:</strong> {{ $registration->full_name }}<br>
            <strong>Email:</strong> {{ $registration->email }}
        </p>

        <form method="POST" action="{{ route('admin.registrations.update', $registration) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="status" class="form-label">Status Pendaftaran</label>
                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                    <option value="pending" {{ $registration->status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                    <option value="approved" {{ $registration->status == 'approved' ? 'selected' : '' }}>Disetujui</option>
                    <option value="rejected" {{ $registration->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                </select>
                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="admin_notes" class="form-label">Catatan Admin</label>
                <textarea class="form-control @error('admin_notes') is-invalid @enderror" 
                          id="admin_notes" name="admin_notes" rows="5">{{ $registration->admin_notes }}</textarea>
                @error('admin_notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.registrations.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
