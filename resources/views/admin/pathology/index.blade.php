@extends('layouts.admin')

@section('title', 'Pathology Lab')

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-0 fw-bold text-dark"><i class="fa fa-flask text-warning me-2"></i> Pathology Lab Tests</h4>
            <small class="text-muted">Manage pathology investigations, sample tests, and reports</small>
        </div>
        <div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-secondary me-2"><i class="fa fa-arrow-left me-1"></i> Dashboard</a>
            <button type="button" class="btn btn-sm btn-warning text-dark"><i class="fa fa-plus me-1"></i> Add Test</button>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0 small">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Test Name</th>
                            <th>Short Name</th>
                            <th>Test Type</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Method</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tests as $test)
                        <tr>
                            <td>{{ $test->id }}</td>
                            <td class="fw-semibold">{{ $test->test_name }}</td>
                            <td>{{ $test->short_name ?? 'N/A' }}</td>
                            <td>{{ $test->test_type ?? 'N/A' }}</td>
                            <td><span class="badge bg-light text-dark border">{{ $test->category_name ?? 'General' }}</span></td>
                            <td>{{ $test->sub_category ?? 'N/A' }}</td>
                            <td>{{ $test->method ?? 'Standard' }}</td>
                            <td>
                                <button class="btn btn-xs btn-outline-warning text-dark py-0 px-2"><i class="fa fa-eye"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="fa fa-vial fa-3x mb-3 text-muted d-block"></i>
                                No pathology tests found.
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
