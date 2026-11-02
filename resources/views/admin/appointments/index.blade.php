@extends('layouts.admin')

@section('title', 'Appointments')

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-0 fw-bold text-dark"><i class="fa fa-calendar-check text-primary me-2"></i> Doctor Appointments</h4>
            <small class="text-muted">Manage patient doctor visits, slots, and schedules</small>
        </div>
        <div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-secondary me-2"><i class="fa fa-arrow-left me-1"></i> Dashboard</a>
            <button type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus me-1"></i> Add Appointment</button>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0 small">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Patient Name</th>
                            <th>Phone</th>
                            <th>Gender</th>
                            <th>Doctor</th>
                            <th>Appointment Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($appointments as $app)
                        <tr>
                            <td>{{ $app->id }}</td>
                            <td class="fw-semibold">{{ $app->patient_name ?? 'N/A' }}</td>
                            <td>{{ $app->mobileno ?? 'N/A' }}</td>
                            <td>{{ $app->gender ?? 'N/A' }}</td>
                            <td>Dr. {{ ($app->doctor_name ?? '') . ' ' . ($app->doctor_surname ?? '') }}</td>
                            <td>{{ $app->date ?? date('Y-m-d') }}</td>
                            <td><span class="badge bg-success">Approved</span></td>
                            <td>
                                <button class="btn btn-xs btn-outline-primary py-0 px-2"><i class="fa fa-eye"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="fa fa-calendar-times fa-3x mb-3 text-muted d-block"></i>
                                No appointments found.
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
