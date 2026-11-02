@extends('layouts.admin')

@section('title', 'Pharmacy Management')

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-0 fw-bold text-dark"><i class="fa fa-mortar-pestle text-info me-2"></i> Pharmacy Medicines & Stock</h4>
            <small class="text-muted">Manage drug inventory, dosage, and sales</small>
        </div>
        <div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-secondary me-2"><i class="fa fa-arrow-left me-1"></i> Dashboard</a>
            <button type="button" class="btn btn-sm btn-info text-white"><i class="fa fa-plus me-1"></i> Add Medicine</button>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0 small">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Medicine Name</th>
                            <th>Category</th>
                            <th>Company</th>
                            <th>Composition</th>
                            <th>Unit</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($medicines as $med)
                        <tr>
                            <td>{{ $med->id }}</td>
                            <td class="fw-semibold">{{ $med->medicine_name }}</td>
                            <td><span class="badge bg-light text-dark border">{{ $med->medicine_category ?? 'General' }}</span></td>
                            <td>{{ $med->medicine_company ?? 'N/A' }}</td>
                            <td>{{ $med->medicine_composition ?? 'N/A' }}</td>
                            <td>{{ $med->unit ?? 'Strip' }}</td>
                            <td>
                                <button class="btn btn-xs btn-outline-info py-0 px-2"><i class="fa fa-eye"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fa fa-pills fa-3x mb-3 text-muted d-block"></i>
                                No medicines found in pharmacy.
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
