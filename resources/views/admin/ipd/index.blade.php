@extends('layouts.admin')

@section('title', 'IPD - In Patient Department')

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-0 fw-bold text-dark"><i class="fa fa-bed text-success me-2"></i> IPD - In Patient Patient List</h4>
            <small class="text-muted">Manage admitted patients, ward allocations, and rounds</small>
        </div>
        <div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-secondary me-2"><i class="fa fa-arrow-left me-1"></i> Dashboard</a>
            <button type="button" class="btn btn-sm btn-success"><i class="fa fa-plus me-1"></i> Admit Patient</button>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0 small">
                    <thead class="table-light">
                        <tr>
                            <th>IPD No</th>
                            <th>Patient Name</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Doctor</th>
                            <th>Bed</th>
                            <th>Admission Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($patients as $row)
                        <tr>
                            <td><span class="badge bg-light text-dark border">IPDN{{ $row->id }}</span></td>
                            <td class="fw-semibold">{{ $row->patient_name ?? 'N/A' }}</td>
                            <td>{{ $row->gender ?? 'N/A' }}</td>
                            <td>{{ $row->mobileno ?? 'N/A' }}</td>
                            <td>Dr. {{ ($row->doctor_name ?? '') . ' ' . ($row->doctor_surname ?? '') }}</td>
                            <td><span class="badge bg-info text-dark">{{ $row->bed_name ?? 'Bed 1' }}</span></td>
                            <td>{{ $row->date ?? date('Y-m-d') }}</td>
                            <td>
                                <button class="btn btn-xs btn-outline-success py-0 px-2"><i class="fa fa-eye"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="fa fa-bed fa-3x mb-3 text-muted d-block"></i>
                                No IPD records found. Migrate database from System Tools or admit a patient.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
