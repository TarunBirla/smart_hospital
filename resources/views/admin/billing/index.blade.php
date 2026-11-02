@extends('layouts.admin')

@section('title', 'Hospital Billing')

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-0 fw-bold text-dark"><i class="fa fa-file-invoice-dollar text-primary me-2"></i> Patient Billing & Payments</h4>
            <small class="text-muted">Manage invoices, receipts, and outstanding payments</small>
        </div>
        <div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-secondary me-2"><i class="fa fa-arrow-left me-1"></i> Dashboard</a>
            <button type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus me-1"></i> Create Bill</button>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0 small">
                    <thead class="table-light">
                        <tr>
                            <th>Bill No</th>
                            <th>Patient Name</th>
                            <th>Date</th>
                            <th>Doctor</th>
                            <th>Total Amount ($)</th>
                            <th>Discount ($)</th>
                            <th>Net Amount ($)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bills as $bill)
                        <tr>
                            <td><span class="badge bg-light text-dark border">PHARB{{ $bill->id }}</span></td>
                            <td class="fw-semibold">{{ $bill->patient_name ?? 'N/A' }}</td>
                            <td>{{ $bill->date ?? date('Y-m-d') }}</td>
                            <td>Dr. {{ $bill->doctor_name ?? 'N/A' }}</td>
                            <td>{{ number_format($bill->total ?? 0, 2) }}</td>
                            <td>{{ number_format($bill->discount ?? 0, 2) }}</td>
                            <td class="fw-bold text-success">{{ number_format($bill->net_amount ?? 0, 2) }}</td>
                            <td>
                                <button class="btn btn-xs btn-outline-primary py-0 px-2"><i class="fa fa-eye"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="fa fa-file-invoice fa-3x mb-3 text-muted d-block"></i>
                                No billing records found. Migrate database from System Tools or generate a new bill.
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
