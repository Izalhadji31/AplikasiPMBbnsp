@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Kelola Pendaftaran Calon Mahasiswa</h2>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>No Telepon</th>
                <th>Status</th>
                <th>Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($registrations as $index => $registration)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $registration->full_name }}</td>
                    <td>{{ $registration->email }}</td>
                    <td>{{ $registration->phone }}</td>
                    <td>
                        @if($registration->status == 'approved')
                            <span class="badge bg-success">Disetujui</span>
                        @elseif($registration->status == 'rejected')
                            <span class="badge bg-danger">Ditolak</span>
                        @else
                            <span class="badge bg-warning">Menunggu</span>
                        @endif
                    </td>
                    <td>{{ $registration->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.registrations.show', $registration) }}" class="btn btn-sm btn-info">Lihat</a>
                        <a href="{{ route('admin.registrations.edit', $registration) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form method="POST" action="{{ route('admin.registrations.destroy', $registration) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada pendaftaran</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
