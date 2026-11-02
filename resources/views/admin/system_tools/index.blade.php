@extends('layouts.admin')

@section('title', 'System Tools & Database Migration Console')

@section('content')
<div class="dash-page-head">
    <div>
        <h1><i class="fa fa-cogs text-warning me-2"></i> System Tools & Live Maintenance Console</h1>
        <div class="crumb">Home <i class="fa fa-angle-right mx-1"></i> System Tools</div>
    </div>
    <div>
        <span class="badge {{ $dbStatus['connected'] ? 'bg-success' : 'bg-danger' }} fs-6 px-3 py-2 shadow-sm">
            <i class="fa {{ $dbStatus['connected'] ? 'fa-check-circle' : 'fa-times-circle' }} me-1"></i>
            {{ $dbStatus['connected'] ? 'DB Connected (' . $tableCount . ' Tables)' : 'DB Disconnected' }}
        </span>
    </div>
</div>

<div class="row">
            <!-- Left Column: Database Setup & Migration -->
            <div class="col-lg-6 col-12 mb-4">
                <!-- 1. Database Configuration Card -->
                <div class="card shadow-sm border-0 mb-4 rounded-3">
                    <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between py-3">
                        <h6 class="mb-0 fw-semibold"><i class="fa fa-database me-2"></i> Step 1: Database Setup & Auto-Create</h6>
                        <span class="badge bg-light text-primary">Live Server Ready</span>
                    </div>
                    <div class="card-body">
                        <form id="dbSetupForm">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label class="form-label fw-bold small">Database Host</label>
                                    <input type="text" name="db_host" class="form-control form-control-sm" value="{{ $envConfig['db_host'] }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold small">Port</label>
                                    <input type="text" name="db_port" class="form-control form-control-sm" value="{{ $envConfig['db_port'] }}" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-bold small">Database Name <small class="text-muted">(Auto-created if not exists)</small></label>
                                    <input type="text" name="db_database" class="form-control form-control-sm" value="{{ $envConfig['db_database'] }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">Username</label>
                                    <input type="text" name="db_username" class="form-control form-control-sm" value="{{ $envConfig['db_username'] }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">Password</label>
                                    <input type="password" name="db_password" class="form-control form-control-sm" value="{{ $envConfig['db_password'] }}" placeholder="DB Password">
                                </div>
                            </div>
                            <div class="mt-4 d-flex justify-content-end">
                                <button type="submit" id="btnSaveDb" class="btn btn-primary btn-sm px-4 shadow-sm">
                                    <i class="fa fa-save me-1"></i> Save & Create Database
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- 2. Database Migration & SQL Import Card -->
                <div class="card shadow-sm border-0 mb-4 rounded-3">
                    <div class="card-header bg-success text-white d-flex align-items-center justify-content-between py-3">
                        <h6 class="mb-0 fw-semibold"><i class="fa fa-upload me-2"></i> Step 2: Migrate & Import Full Database</h6>
                        <span class="badge bg-light text-success">205 Hospital Tables</span>
                    </div>
                    <div class="card-body">
                        <p class="small text-muted mb-3">
                            Ye button click karne par poora Smart Hospital schema, tables, seeders aur initial master records database me migrate ho jayenge:
                        </p>
                        <form id="dbImportForm">
                            @csrf
                            <div class="row g-2 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">Admin Email</label>
                                    <input type="email" name="admin_email" class="form-control form-control-sm" value="admin@smart-hospital.com" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">Admin Password</label>
                                    <input type="text" name="admin_password" class="form-control form-control-sm" value="admin123" required>
                                </div>
                            </div>
                            <div class="alert alert-info py-2 px-3 small border-0 mb-3 rounded-2">
                                <i class="fa fa-info-circle me-1"></i> Super Admin account automatically create hoga jisse aap login kar sakenge.
                            </div>
                            <button type="submit" id="btnImportDb" class="btn btn-success btn-sm w-100 py-2 fw-semibold shadow-sm">
                                <i class="fa fa-sync fa-spin d-none me-1" id="importSpinner"></i>
                                <i class="fa fa-play-circle me-1" id="importIcon"></i> Run Full Database Migration & SQL Import
                            </button>
                        </form>
                    </div>
                </div>

                <!-- 3. Server Diagnostics Card -->
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-light d-flex align-items-center justify-content-between py-2">
                        <h6 class="mb-0 fw-semibold text-dark"><i class="fa fa-check-square me-2 text-info"></i> Server Requirements</h6>
                        <small class="text-muted">Environment Diagnostics</small>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush small">
                            @foreach($requirements as $key => $req)
                            <li class="list-group-item d-flex justify-content-between align-items-center py-2 px-3">
                                <span>{{ $req['name'] }}</span>
                                <span class="badge {{ $req['passed'] ? 'bg-success' : 'bg-danger' }}">
                                    {{ $req['current'] }}
                                </span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Right Column: Live Artisan Commands Console -->
            <div class="col-lg-6 col-12">
                <!-- 1. Quick Artisan Clear & Action Buttons -->
                <div class="card shadow-sm border-0 mb-4 rounded-3">
                    <div class="card-header bg-dark text-white d-flex align-items-center justify-content-between py-3">
                        <h6 class="mb-0 fw-semibold"><i class="fa fa-terminal me-2 text-warning"></i> 1-Click Maintenance Commands</h6>
                        <span class="badge bg-secondary">Live Server Tools</span>
                    </div>
                    <div class="card-body">
                        <div class="row g-2 mb-3">
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-outline-primary btn-sm w-100 text-start py-2 cmd-btn" data-cmd="storage:link">
                                    <i class="fa fa-link me-2 text-primary"></i> <b>storage:link</b>
                                    <div class="text-muted small ps-4">Link public storage folder</div>
                                </button>
                            </div>
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-outline-danger btn-sm w-100 text-start py-2 cmd-btn" data-cmd="optimize:clear">
                                    <i class="fa fa-broom me-2 text-danger"></i> <b>optimize:clear</b>
                                    <div class="text-muted small ps-4">Clear all cache & compiled files</div>
                                </button>
                            </div>
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-outline-warning btn-sm w-100 text-start py-2 cmd-btn" data-cmd="config:clear">
                                    <i class="fa fa-cog me-2 text-warning"></i> <b>config:clear</b>
                                    <div class="text-muted small ps-4">Clear configuration cache</div>
                                </button>
                            </div>
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-outline-info btn-sm w-100 text-start py-2 cmd-btn" data-cmd="cache:clear">
                                    <i class="fa fa-hdd me-2 text-info"></i> <b>cache:clear</b>
                                    <div class="text-muted small ps-4">Clear application cache</div>
                                </button>
                            </div>
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-outline-success btn-sm w-100 text-start py-2 cmd-btn" data-cmd="route:clear">
                                    <i class="fa fa-road me-2 text-success"></i> <b>route:clear</b>
                                    <div class="text-muted small ps-4">Clear route cache</div>
                                </button>
                            </div>
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-outline-secondary btn-sm w-100 text-start py-2 cmd-btn" data-cmd="view:clear">
                                    <i class="fa fa-eye me-2 text-secondary"></i> <b>view:clear</b>
                                    <div class="text-muted small ps-4">Clear compiled Blade views</div>
                                </button>
                            </div>
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-outline-dark btn-sm w-100 text-start py-2 cmd-btn" data-cmd="key:generate">
                                    <i class="fa fa-key me-2 text-dark"></i> <b>key:generate</b>
                                    <div class="text-muted small ps-4">Generate app encryption key</div>
                                </button>
                            </div>
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-outline-primary btn-sm w-100 text-start py-2 cmd-btn" data-cmd="migrate:status">
                                    <i class="fa fa-list-check me-2 text-primary"></i> <b>migrate:status</b>
                                    <div class="text-muted small ps-4">Check migration status</div>
                                </button>
                            </div>
                        </div>

                        <!-- Custom Command Bar -->
                        <div class="input-group">
                            <span class="input-group-text bg-light fw-bold font-monospace small">php artisan</span>
                            <input type="text" id="customCommandInput" class="form-control font-monospace form-control-sm" placeholder="e.g. optimize:clear or about">
                            <button class="btn btn-dark btn-sm px-3" type="button" id="btnRunCustom">
                                <i class="fa fa-play me-1"></i> Run
                            </button>
                        </div>
                    </div>
                </div>

                <!-- 2. Live Terminal Output Box -->
                <div class="card shadow-sm border-0 rounded-3 bg-dark text-white">
                    <div class="card-header bg-black text-white d-flex align-items-center justify-content-between py-2 border-bottom border-secondary">
                        <span class="small font-monospace text-success"><i class="fa fa-terminal me-2"></i> Live Console Output</span>
                        <div>
                            <button type="button" class="btn btn-xs btn-outline-secondary py-0 px-2 small text-light" id="btnClearTerminal">
                                <i class="fa fa-eraser"></i> Clear
                            </button>
                            <button type="button" class="btn btn-xs btn-outline-secondary py-0 px-2 small text-light ms-1" id="btnCopyTerminal">
                                <i class="fa fa-copy"></i> Copy
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-3 font-monospace small bg-black text-light rounded-bottom" id="terminalBox" style="min-height: 280px; max-height: 400px; overflow-y: auto; font-family: 'Consolas', monospace; white-space: pre-wrap; font-size: 12px; line-height: 1.5;">
<span class="text-success">[System Ready]</span> Smart Hospital Maintenance Console initialized.
Click any button above or run commands to see output here.
                    </div>
                </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    function logTerminal(title, output, isError = false) {
        var box = $('#terminalBox');
        var time = new Date().toLocaleTimeString();
        var color = isError ? 'text-danger' : 'text-success';
        var border = isError ? 'border-danger' : 'border-success';

        var html = '\n<div class="mt-2 pt-2 border-top border-secondary">';
        html += '<span class="text-muted">[' + time + ']</span> <b class="' + color + '">' + title + '</b>\n';
        html += '<span class="' + (isError ? 'text-danger' : 'text-light') + '">' + output + '</span>';
        html += '</div>';

        box.append(html);
        box.scrollTop(box[0].scrollHeight);
    }

    // 1. Run Command Buttons
    $('.cmd-btn').on('click', function(e) {
        e.preventDefault();
        var cmd = $(this).data('cmd');
        executeArtisan(cmd);
    });

    $('#btnRunCustom').on('click', function() {
        var cmd = $('#customCommandInput').val().trim();
        if(cmd) {
            executeArtisan(cmd);
        }
    });

    $('#customCommandInput').on('keypress', function(e) {
        if(e.which === 13) {
            $('#btnRunCustom').click();
        }
    });

    function executeArtisan(cmd) {
        logTerminal('> Executing: php artisan ' + cmd, 'Running command, please wait...');

        $.ajax({
            url: "{{ route('system_tools.run_command') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                command: cmd
            },
            success: function(res) {
                logTerminal('> Result: php artisan ' + cmd, res.output, !res.success);
            },
            error: function(xhr) {
                var msg = xhr.responseJSON ? xhr.responseJSON.output : 'Server error occurred.';
                logTerminal('> Error: php artisan ' + cmd, msg, true);
            }
        });
    }

    // 2. Database Setup Form
    $('#dbSetupForm').on('submit', function(e) {
        e.preventDefault();
        var btn = $('#btnSaveDb');
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-1"></i> Connecting & Creating...');

        $.ajax({
            url: "{{ route('system_tools.setup_database') }}",
            type: "POST",
            data: $(this).serialize(),
            success: function(res) {
                btn.prop('disabled', false).html('<i class="fa fa-save me-1"></i> Save & Create Database');
                logTerminal('> Database Setup', res.message, false);
                alert(res.message);
                location.reload();
            },
            error: function(xhr) {
                btn.prop('disabled', false).html('<i class="fa fa-save me-1"></i> Save & Create Database');
                var msg = xhr.responseJSON ? xhr.responseJSON.message : 'Database connection error.';
                logTerminal('> Database Setup Error', msg, true);
                alert('Database Error: ' + msg);
            }
        });
    });

    // 3. Database Import Form
    $('#dbImportForm').on('submit', function(e) {
        e.preventDefault();
        if(!confirm('Are you sure you want to import the full database? This will create all 205 tables and initial data.')) {
            return;
        }

        var btn = $('#btnImportDb');
        $('#importSpinner').removeClass('d-none');
        $('#importIcon').addClass('d-none');
        btn.prop('disabled', true);

        logTerminal('> Database Migration', 'Starting full database.sql import... This may take 30-60 seconds.');

        $.ajax({
            url: "{{ route('system_tools.import_database') }}",
            type: "POST",
            data: $(this).serialize(),
            timeout: 600000,
            success: function(res) {
                btn.prop('disabled', false);
                $('#importSpinner').addClass('d-none');
                $('#importIcon').removeClass('d-none');

                var out = res.message + '\nAdmin Email: ' + res.admin_email + '\nAdmin Password: ' + res.admin_password;
                logTerminal('> Migration Success', out, false);
                alert('Success! ' + res.message);
                location.reload();
            },
            error: function(xhr) {
                btn.prop('disabled', false);
                $('#importSpinner').addClass('d-none');
                $('#importIcon').removeClass('d-none');

                var msg = xhr.responseJSON ? xhr.responseJSON.message : 'Import failed.';
                logTerminal('> Migration Error', msg, true);
                alert('Migration Error: ' + msg);
            }
        });
    });

    // 4. Terminal Helpers
    $('#btnClearTerminal').on('click', function() {
        $('#terminalBox').html('<span class="text-success">[Terminal Cleared]</span>');
    });

    $('#btnCopyTerminal').on('click', function() {
        var text = $('#terminalBox').text();
        navigator.clipboard.writeText(text).then(function() {
            alert('Terminal output copied to clipboard!');
        });
    });
});
</script>
@endpush
