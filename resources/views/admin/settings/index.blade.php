@extends('layouts.admin')

@section('title', 'General Settings')

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-0 fw-bold text-dark"><i class="fa fa-sliders text-primary me-2"></i> General Hospital Settings</h4>
            <small class="text-muted">Configure hospital profile, currency, timezone, and print layouts</small>
        </div>
        <div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-secondary me-2"><i class="fa fa-arrow-left me-1"></i> Dashboard</a>
            <a href="{{ route('system_tools.index') }}" class="btn btn-sm btn-warning"><i class="fa fa-cogs me-1"></i> System Tools & Console</a>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-4">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold small">Hospital Name</label>
                    <input type="text" class="form-control form-control-sm" value="{{ $settings->name ?? 'Smart Hospital' }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold small">Hospital Code</label>
                    <input type="text" class="form-control form-control-sm" value="{{ $settings->dise_code ?? 'SH001' }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold small">Hospital Phone</label>
                    <input type="text" class="form-control form-control-sm" value="{{ $settings->phone ?? '+1-555-0199' }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold small">Hospital Email</label>
                    <input type="text" class="form-control form-control-sm" value="{{ $settings->email ?? 'contact@smart-hospital.com' }}" readonly>
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-bold small">Address</label>
                    <textarea class="form-control form-control-sm" rows="2" readonly>{{ $settings->address ?? '123 Medical Center Boulevard, City, Country' }}</textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold small">Currency</label>
                    <input type="text" class="form-control form-control-sm" value="{{ $settings->currency ?? 'USD ($)' }}" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold small">Timezone</label>
                    <input type="text" class="form-control form-control-sm" value="{{ $settings->timezone ?? 'UTC' }}" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold small">License Status</label>
                    <input type="text" class="form-control form-control-sm text-success fw-bold" value="Verified & Unlocked (Key Bypass)" readonly>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
