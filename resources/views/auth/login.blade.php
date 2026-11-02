<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Hospital · Login</title>
    <link href="{{ asset('backend/bootstrap5/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/dist/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/images/s-favican.png') }}" rel="shortcut icon" type="image/x-icon">
    <style>
        body {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-card {
            width: 100%;
            max-width: 420px;
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.25);
            background: #fff;
            overflow: hidden;
        }
        .login-header {
            background: #0d6efd;
            padding: 30px 20px;
            text-align: center;
            color: #fff;
        }
        .login-header img {
            max-height: 48px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="login-header">
        <img src="{{ asset('backend/images/s_logo.png') }}" alt="Smart Hospital">
        <h5 class="mb-0 fw-bold">Smart Hospital</h5>
        <small class="text-white-50">Hospital Management System</small>
    </div>
    <div class="p-4">
        @if($errors->any())
            <div class="alert alert-danger py-2 px-3 small border-0 mb-3">
                <i class="fa fa-exclamation-circle me-1"></i> {{ $errors->first() }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-warning py-2 px-3 small border-0 mb-3">
                <i class="fa fa-info-circle me-1"></i> {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label small fw-semibold text-muted">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="fa fa-envelope text-muted"></i></span>
                    <input type="email" name="email" class="form-control border-start-0" placeholder="admin@smart-hospital.com" value="{{ old('email', 'admin@smart-hospital.com') }}" required autofocus>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold text-muted">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="fa fa-lock text-muted"></i></span>
                    <input type="password" name="password" class="form-control border-start-0" placeholder="Password" value="admin123" required>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                    <label class="form-check-label small text-muted" for="rememberMe">Remember me</label>
                </div>
                <a href="{{ route('system_tools.index') }}" class="small text-decoration-none text-primary fw-semibold">
                    <i class="fa fa-cogs"></i> System Tools
                </a>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold shadow-sm">
                <i class="fa fa-sign-in me-1"></i> Sign In
            </button>
        </form>

        <div class="mt-4 pt-3 border-top text-center">
            <span class="small text-muted">Need to setup or migrate database?</span><br>
            <a href="{{ route('system_tools.index') }}" class="btn btn-sm btn-outline-warning text-dark mt-2 fw-bold">
                <i class="fa fa-database me-1"></i> Open Live Installer & Console
            </a>
        </div>
    </div>
</div>

</body>
</html>
