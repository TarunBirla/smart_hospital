@extends('layouts.admin')

@section('title', 'Blood Bank')

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-0 fw-bold text-dark"><i class="fa fa-tint text-danger me-2"></i> Blood Bank Status & Products</h4>
            <small class="text-muted">Manage blood bags, donor records, component separation, and issue</small>
        </div>
        <div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-secondary me-2"><i class="fa fa-arrow-left me-1"></i> Dashboard</a>
            <button type="button" class="btn btn-sm btn-danger"><i class="fa fa-plus me-1"></i> Issue Blood</button>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0 small">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Blood Group / Product</th>
                            <th>Type</th>
                            <th>Available Bags</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $prod)
                        <tr>
                            <td>{{ $prod->id }}</td>
                            <td class="fw-bold text-danger"><i class="fa fa-tint me-1"></i> {{ $prod->name }}</td>
                            <td>{{ $prod->is_blood_group ? 'Blood Group' : 'Component' }}</td>
                            <td><span class="badge bg-success">In Stock</span></td>
                            <td><span class="badge bg-light text-dark border">Available</span></td>
                            <td>
                                <button class="btn btn-xs btn-outline-danger py-0 px-2"><i class="fa fa-eye"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fa fa-tint-slash fa-3x mb-3 text-muted d-block"></i>
                                No blood bank records found.
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
