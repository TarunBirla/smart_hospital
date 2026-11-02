@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid px-0">
    <!-- Notice if DB not migrated yet -->
    @if(!$dbConnected || ($stats['opd_count'] == 0 && $stats['appointment_count'] == 0))
    <div class="alert alert-warning border-0 shadow-sm d-flex align-items-center justify-content-between p-3 mb-4 rounded-3">
        <div class="d-flex align-items-center">
            <i class="fa fa-exclamation-triangle fs-3 text-warning me-3"></i>
            <div>
                <h6 class="mb-1 fw-bold text-dark">Database Setup & Migration Required</h6>
                <p class="mb-0 small text-muted">Aap live database create aur poora 205 tables ka schema System Tools page se 1-click me import kar sakte hain.</p>
            </div>
        </div>
        <a href="{{ route('system_tools.index') }}" class="btn btn-warning btn-sm fw-bold px-3 shadow-sm">
            <i class="fa fa-cogs me-1"></i> Open System Tools
        </a>
    </div>
    @endif

    <!-- Top Counter Widgets -->
    <div class="row g-3 mb-4">
        <!-- OPD -->
        <div class="col-xl-3 col-md-6 col-12">
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="rounded-3 bg-primary bg-opacity-10 p-3 me-3 text-primary">
                        <i class="fa fa-stethoscope fa-2x"></i>
                    </div>
                    <div>
                        <span class="text-muted small text-uppercase fw-semibold">OPD Patients</span>
                        <h3 class="mb-0 fw-bold text-dark">{{ $stats['opd_count'] }}</h3>
                    </div>
                </div>
                <div class="bg-primary text-white text-center py-1 small">
                    <a href="{{ route('opd.index') }}" class="text-white text-decoration-none">View OPD Details <i class="fa fa-arrow-circle-right ms-1"></i></a>
                </div>
            </div>
        </div>

        <!-- IPD -->
        <div class="col-xl-3 col-md-6 col-12">
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="rounded-3 bg-success bg-opacity-10 p-3 me-3 text-success">
                        <i class="fa fa-bed fa-2x"></i>
                    </div>
                    <div>
                        <span class="text-muted small text-uppercase fw-semibold">IPD Patients</span>
                        <h3 class="mb-0 fw-bold text-dark">{{ $stats['ipd_count'] }}</h3>
                    </div>
                </div>
                <div class="bg-success text-white text-center py-1 small">
                    <a href="{{ route('ipd.index') }}" class="text-white text-decoration-none">View IPD Details <i class="fa fa-arrow-circle-right ms-1"></i></a>
                </div>
            </div>
        </div>

        <!-- Pharmacy -->
        <div class="col-xl-3 col-md-6 col-12">
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="rounded-3 bg-info bg-opacity-10 p-3 me-3 text-info">
                        <i class="fa fa-mortar-pestle fa-2x"></i>
                    </div>
                    <div>
                        <span class="text-muted small text-uppercase fw-semibold">Pharmacy Bills</span>
                        <h3 class="mb-0 fw-bold text-dark">{{ $stats['pharmacy_count'] }}</h3>
                    </div>
                </div>
                <div class="bg-info text-white text-center py-1 small">
                    <a href="{{ route('pharmacy.index') }}" class="text-white text-decoration-none">View Pharmacy <i class="fa fa-arrow-circle-right ms-1"></i></a>
                </div>
            </div>
        </div>

        <!-- Pathology -->
        <div class="col-xl-3 col-md-6 col-12">
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="rounded-3 bg-warning bg-opacity-10 p-3 me-3 text-warning">
                        <i class="fa fa-flask fa-2x"></i>
                    </div>
                    <div>
                        <span class="text-muted small text-uppercase fw-semibold">Pathology Tests</span>
                        <h3 class="mb-0 fw-bold text-dark">{{ $stats['pathology_count'] }}</h3>
                    </div>
                </div>
                <div class="bg-warning text-white text-center py-1 small">
                    <a href="{{ route('pathology.index') }}" class="text-white text-decoration-none">View Pathology <i class="fa fa-arrow-circle-right ms-1"></i></a>
                </div>
            </div>
        </div>

        <!-- Radiology -->
        <div class="col-xl-3 col-md-6 col-12">
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="rounded-3 bg-danger bg-opacity-10 p-3 me-3 text-danger">
                        <i class="fa fa-microscope fa-2x"></i>
                    </div>
                    <div>
                        <span class="text-muted small text-uppercase fw-semibold">Radiology Tests</span>
                        <h3 class="mb-0 fw-bold text-dark">{{ $stats['radiology_count'] }}</h3>
                    </div>
                </div>
                <div class="bg-danger text-white text-center py-1 small">
                    <a href="{{ route('radiology.index') }}" class="text-white text-decoration-none">View Radiology <i class="fa fa-arrow-circle-right ms-1"></i></a>
                </div>
            </div>
        </div>

        <!-- Blood Bank -->
        <div class="col-xl-3 col-md-6 col-12">
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="rounded-3 bg-secondary bg-opacity-10 p-3 me-3 text-secondary">
                        <i class="fa fa-tint fa-2x"></i>
                    </div>
                    <div>
                        <span class="text-muted small text-uppercase fw-semibold">Blood Bank Issues</span>
                        <h3 class="mb-0 fw-bold text-dark">{{ $stats['blood_bank_count'] }}</h3>
                    </div>
                </div>
                <div class="bg-secondary text-white text-center py-1 small">
                    <a href="{{ route('blood_bank.index') }}" class="text-white text-decoration-none">View Blood Bank <i class="fa fa-arrow-circle-right ms-1"></i></a>
                </div>
            </div>
        </div>

        <!-- Ambulance -->
        <div class="col-xl-3 col-md-6 col-12">
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="rounded-3 bg-dark bg-opacity-10 p-3 me-3 text-dark">
                        <i class="fa fa-ambulance fa-2x"></i>
                    </div>
                    <div>
                        <span class="text-muted small text-uppercase fw-semibold">Ambulance Calls</span>
                        <h3 class="mb-0 fw-bold text-dark">{{ $stats['ambulance_count'] }}</h3>
                    </div>
                </div>
                <div class="bg-dark text-white text-center py-1 small">
                    <a href="{{ route('admin.dashboard') }}" class="text-white text-decoration-none">View Ambulance <i class="fa fa-arrow-circle-right ms-1"></i></a>
                </div>
            </div>
        </div>

        <!-- Appointments -->
        <div class="col-xl-3 col-md-6 col-12">
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="rounded-3 bg-primary bg-opacity-10 p-3 me-3 text-primary">
                        <i class="fa fa-calendar-check fa-2x"></i>
                    </div>
                    <div>
                        <span class="text-muted small text-uppercase fw-semibold">Appointments</span>
                        <h3 class="mb-0 fw-bold text-dark">{{ $stats['appointment_count'] }}</h3>
                    </div>
                </div>
                <div class="bg-primary text-white text-center py-1 small">
                    <a href="{{ route('appointments.index') }}" class="text-white text-decoration-none">View Appointments <i class="fa fa-arrow-circle-right ms-1"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Tools Bar -->
    <div class="card border-0 shadow-sm rounded-3 mb-4">
        <div class="card-header bg-white py-3 border-0">
            <h6 class="mb-0 fw-bold text-dark"><i class="fa fa-bolt text-warning me-2"></i> Quick Actions & Maintenance</h6>
        </div>
        <div class="card-body pt-0">
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('system_tools.index') }}" class="btn btn-sm btn-outline-primary shadow-sm">
                    <i class="fa fa-cogs me-1"></i> System Tools & Migration
                </a>
                <a href="{{ route('opd.index') }}" class="btn btn-sm btn-outline-success shadow-sm">
                    <i class="fa fa-user-plus me-1"></i> New OPD Patient
                </a>
                <a href="{{ route('appointments.index') }}" class="btn btn-sm btn-outline-info shadow-sm">
                    <i class="fa fa-calendar-plus me-1"></i> Book Appointment
                </a>
                <a href="{{ route('billing.index') }}" class="btn btn-sm btn-outline-warning text-dark shadow-sm">
                    <i class="fa fa-file-invoice me-1"></i> Generate Bill
                </a>
                <a href="{{ route('staff.index') }}" class="btn btn-sm btn-outline-dark shadow-sm">
                    <i class="fa fa-user-md me-1"></i> Staff Directory
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Appointments Table -->
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between border-0">
            <h6 class="mb-0 fw-bold text-dark"><i class="fa fa-calendar-alt text-primary me-2"></i> Recent Appointments</h6>
            <a href="{{ route('appointments.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0 small">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Patient Name</th>
                            <th>Phone</th>
                            <th>Doctor</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentAppointments as $app)
                        <tr>
                            <td>{{ $app->id }}</td>
                            <td class="fw-semibold">{{ $app->patient_name ?? 'N/A' }}</td>
                            <td>{{ $app->mobileno ?? 'N/A' }}</td>
                            <td>{{ $app->doctor ?? 'Dr. Specialist' }}</td>
                            <td>{{ $app->date ?? date('Y-m-d') }}</td>
                            <td>
                                <span class="badge bg-success">Approved</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="fa fa-folder-open fa-2x mb-2 d-block"></i>
                                No appointment records found in database.
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
