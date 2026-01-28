@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">Total User</h5>
                <h2>{{ $totalUsers }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5 class="card-title">Total Pendaftaran</h5>
                <h2>{{ $totalRegistrations }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">Disetujui</h5>
                <h2>{{ $approvedRegistrations }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <h5 class="card-title">Menunggu</h5>
                <h2>{{ $pendingRegistrations }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <h4>Navigasi Admin</h4>
        <div class="btn-group" role="group">
            <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Kelola User</a>
            <a href="{{ route('admin.registrations.index') }}" class="btn btn-info">Kelola Pendaftaran</a>
            <a href="{{ route('admin.users.create') }}" class="btn btn-success">Tambah User</a>
        </div>
    </div>
</div>
@endsection
