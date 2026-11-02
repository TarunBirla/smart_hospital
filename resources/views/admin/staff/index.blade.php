@extends('layouts.admin')

@section('title', 'Staff Directory')

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-0 fw-bold text-dark"><i class="fa fa-sitemap text-dark me-2"></i> Staff Directory & Roles</h4>
            <small class="text-muted">Manage hospital doctors, nurses, accountants, pharmacists, and admins</small>
        </div>
        <div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-secondary me-2"><i class="fa fa-arrow-left me-1"></i> Dashboard</a>
            <button type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus me-1"></i> Add Staff</button>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0 small">
                    <thead class="table-light">
                        <tr>
                            <th>Staff ID</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Mobile Number</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($staffMembers as $staff)
                        <tr>
                            <td><span class="badge bg-light text-dark border">{{ $staff->employee_id ?? $staff->id }}</span></td>
                            <td class="fw-semibold">{{ $staff->name }} {{ $staff->surname }}</td>
                            <td><span class="badge bg-primary">{{ $staff->role_name ?? 'Staff' }}</span></td>
                            <td>{{ $staff->department ?? 'General' }}</td>
                            <td>{{ $staff->designation ?? 'Consultant' }}</td>
                            <td>{{ $staff->contact_no ?? 'N/A' }}</td>
                            <td>
                                <span class="badge {{ $staff->is_active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $staff->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-xs btn-outline-primary py-0 px-2"><i class="fa fa-eye"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="fa fa-users-slash fa-3x mb-3 text-muted d-block"></i>
                                No staff members found.
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
