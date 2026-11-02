@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<!-- ═══════════ Page header ═══════════ -->
<div class="dash-page-head">
    <div>
        <h1>Hospital Dashboard</h1>
        <div class="crumb">Home <i class="fa fa-angle-right mx-1"></i> Dashboard</div>
    </div>
    <div class="dash-btn-row">
        <a href="{{ route('system_tools.index') }}" class="dash-btn primary">
            <i class="fa fa-cogs"></i> System Tools & Migration
        </a>
    </div>
</div>

<!-- Notice if DB not migrated yet -->
@if(!$dbConnected || ($stats['opd_count'] == 0 && $stats['appointment_count'] == 0))
<div class="alert alert-warning border-0 shadow-sm d-flex align-items-center justify-content-between p-3 mb-4 rounded-3">
    <div class="d-flex align-items-center">
        <i class="fa fa-exclamation-triangle fs-3 text-warning me-3"></i>
        <div>
            <h6 class="mb-1 fw-bold text-dark">Database Setup & Full Migration Required</h6>
            <p class="mb-0 small text-muted">Aap live database create aur poora 205 tables ka schema System Tools page se 1-click me import kar sakte hain.</p>
        </div>
    </div>
    <a href="{{ route('system_tools.index') }}" class="btn btn-warning btn-sm fw-bold px-3 shadow-sm">
        <i class="fa fa-cogs me-1"></i> Open System Tools
    </a>
</div>
@endif

<!-- ═══════════ Hero KPIs (4 tiles with sparkline + delta) ═══════════ -->
<div class="kpi-grid">
    <!-- OPD -->
    <a class="kpi s-blue" href="{{ route('opd.index') }}">
        <div class="kpi-label">OPD Patients · Total</div>
        <div class="kpi-value">{{ $stats['opd_count'] }}</div>
        <div class="kpi-delta"><i class="fas fa-stethoscope"></i> Out Patient Department</div>
        <svg class="kpi-spark" viewBox="0 0 120 32" preserveAspectRatio="none" aria-hidden="true">
            <path class="fill" d="M0,26 L20,22 L40,24 L60,18 L80,16 L100,10 L120,8 L120,32 L0,32 Z"/>
            <path class="line" d="M0,26 L20,22 L40,24 L60,18 L80,16 L100,10 L120,8"/>
        </svg>
    </a>

    <!-- IPD -->
    <a class="kpi s-teal" href="{{ route('ipd.index') }}">
        <div class="kpi-label">IPD Patients · In Ward</div>
        <div class="kpi-value">{{ $stats['ipd_count'] }}</div>
        <div class="kpi-delta"><i class="fas fa-bed"></i> In Patient Department</div>
        <svg class="kpi-spark" viewBox="0 0 120 32" preserveAspectRatio="none" aria-hidden="true">
            <path class="fill" d="M0,18 L20,20 L40,16 L60,14 L80,12 L100,14 L120,10 L120,32 L0,32 Z"/>
            <path class="line" d="M0,18 L20,20 L40,16 L60,14 L80,12 L100,14 L120,10"/>
        </svg>
    </a>

    <!-- Appointments -->
    <a class="kpi s-green" href="{{ route('appointments.index') }}">
        <div class="kpi-label">Doctor Appointments</div>
        <div class="kpi-value">{{ $stats['appointment_count'] }}</div>
        <div class="kpi-delta"><i class="fas fa-calendar-check"></i> Scheduled Visits</div>
        <svg class="kpi-spark" viewBox="0 0 120 32" preserveAspectRatio="none" aria-hidden="true">
            <path class="fill" d="M0,24 L20,22 L40,20 L60,22 L80,16 L100,14 L120,12 L120,32 L0,32 Z"/>
            <path class="line" d="M0,24 L20,22 L40,20 L60,22 L80,16 L100,14 L120,12"/>
        </svg>
    </a>

    <!-- Pharmacy Bills -->
    <a class="kpi s-amber" href="{{ route('pharmacy.index') }}">
        <div class="kpi-label">Pharmacy Sales / Bills</div>
        <div class="kpi-value">{{ $stats['pharmacy_count'] }}</div>
        <div class="kpi-delta"><i class="fas fa-mortar-pestle"></i> Medicine Dispensary</div>
        <svg class="kpi-spark" viewBox="0 0 120 32" preserveAspectRatio="none" aria-hidden="true">
            <path class="fill" d="M0,14 L20,16 L40,18 L60,16 L80,20 L100,22 L120,24 L120,32 L0,32 Z"/>
            <path class="line" d="M0,14 L20,16 L40,18 L60,16 L80,20 L100,22 L120,24"/>
        </svg>
    </a>
</div>

<!-- ═══════════ Operations snapshot (4 cards) ═══════════ -->
<div class="ops-grid">
    <!-- Pathology -->
    <div class="ops-card">
        <div class="head">
            <div class="ic blue"><i class="fas fa-flask"></i></div>
            <div class="lbl">Pathology Lab</div>
            <a class="meta" href="{{ route('pathology.index') }}">View</a>
        </div>
        <div class="big">{{ $stats['pathology_count'] }}</div>
        <div class="sub">Total lab tests and investigations</div>
    </div>

    <!-- Radiology -->
    <div class="ops-card">
        <div class="head">
            <div class="ic teal"><i class="fas fa-microscope"></i></div>
            <div class="lbl">Radiology Scans</div>
            <a class="meta" href="{{ route('radiology.index') }}">View</a>
        </div>
        <div class="big">{{ $stats['radiology_count'] }}</div>
        <div class="sub">X-Ray, CT Scan, Ultrasound, MRI</div>
    </div>

    <!-- Blood Bank -->
    <div class="ops-card">
        <div class="head">
            <div class="ic red"><i class="fas fa-tint"></i></div>
            <div class="lbl">Blood Bank</div>
            <a class="meta" href="{{ route('blood_bank.index') }}">Inventory</a>
        </div>
        <div class="big">{{ $stats['blood_bank_count'] }}</div>
        <div class="sub">Blood issue and donor cycles</div>
    </div>

    <!-- Ambulance -->
    <div class="ops-card">
        <div class="head">
            <div class="ic amber"><i class="fas fa-ambulance"></i></div>
            <div class="lbl">Ambulance Service</div>
            <a class="meta" href="{{ route('admin.dashboard') }}">Fleet</a>
        </div>
        <div class="big">{{ $stats['ambulance_count'] }}</div>
        <div class="sub">Emergency vehicle dispatches</div>
    </div>
</div>

<!-- ═══════════ Recent Appointments Table ═══════════ -->
<div class="dash-table-card">
    <div class="dash-table-card-h">
        <h3><i class="fa fa-calendar-check-o text-primary me-2"></i> Recent Doctor Appointments</h3>
        <a href="{{ route('appointments.index') }}" class="dash-btn sm">View All</a>
    </div>
    <table class="dash-tbl">
        <thead>
            <tr>
                <th>#</th>
                <th>Patient Name</th>
                <th>Contact</th>
                <th>Doctor</th>
                <th>Appointment Date</th>
                <th class="num">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentAppointments as $app)
            <tr>
                <td><strong>APT{{ $app->id }}</strong></td>
                <td>{{ $app->patient_name ?? 'N/A' }}</td>
                <td>{{ $app->mobileno ?? 'N/A' }}</td>
                <td>Dr. {{ $app->doctor ?? 'Specialist' }}</td>
                <td>{{ $app->date ?? date('Y-m-d') }}</td>
                <td class="num"><span class="badge-pill ok">Approved</span></td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="empty">No appointment records found in database. Run migration from System Tools.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
