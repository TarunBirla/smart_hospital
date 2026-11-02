<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Smart Hospital') · Hospital Management System</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Fonts: Inter + Roboto + Nunito + JetBrains Mono -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Roboto:wght@400;500;700;900&family=Nunito:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

  <!-- 1. Bootstrap 5.3.3 -->
  <link href="{{ asset('backend/bootstrap5/css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- 2. Design tokens -->
  <link href="{{ asset('backend/css/sh-tokens.css') }}" rel="stylesheet">

  <!-- 3. DataTables CSS -->
  <link href="{{ asset('backend/dist/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/plugins/datatables/dataTables.bootstrap5.css') }}" rel="stylesheet">

  <!-- 4. Font Awesome 5 + 4 -->
  <link href="{{ asset('backend/dist/css/all.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/dist/css/font-awesome.min.css') }}" rel="stylesheet">

  <!-- 5. Select2 CSS -->
  <link href="{{ asset('backend/plugins/select2/select2.min.css') }}" rel="stylesheet">

  <!-- 6. Toastr notifications CSS -->
  <link href="{{ asset('backend/toast-alert/toastr.css') }}" rel="stylesheet">

  <!-- 7. SH Theme & Dashboard CSS -->
  <link href="{{ asset('backend/css/sh-theme.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/css/sh-dashboard.css') }}" rel="stylesheet">

  <!-- Favicon -->
  <link href="{{ asset('backend/images/s-favican.png') }}" rel="shortcut icon" type="image/x-icon">

  <!-- jQuery -->
  <script src="{{ asset('backend/custom/jquery.min.js') }}"></script>
  <script src="{{ asset('backend/dist/js/jquery-ui.min.js') }}"></script>

  <script>
    var baseurl = "{{ url('/') }}";
    var SH_BASE = baseurl;
    var SH_CSRF_TOKEN = "{{ csrf_token() }}";
  </script>

  @stack('styles')
</head>
<body class="variant-clinical" data-preset="clinical" data-chrome="dashboard">
<script>
/* Sidebar collapsed state restore */
(function(){try{if(localStorage.getItem('sh_sidebar_collapsed')==='1'){document.body.classList.add('sidebar-collapsed');}}catch(e){}})();
</script>

<!-- ═══════════════════ SIDEBAR ═══════════════════ -->
<aside class="sh-sidebar" id="shSidebar">
  <!-- Brand logo -->
  <div class="sidebar-brand">
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
      <img src="{{ asset('backend/images/s_logo.png') }}" alt="Logo" class="brand-image">
      <span class="brand-text">Smart Hospital</span>
    </a>
  </div>

  <!-- Sidebar Nav Menu -->
  <div class="sidebar-content">
    <nav class="sidebar-nav">
      <ul class="nav-list">
        <!-- Dashboard -->
        <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
          <a href="{{ route('admin.dashboard') }}" class="nav-link" data-tooltip="Dashboard">
            <i class="nav-icon fa fa-television"></i>
            <span class="nav-title">Dashboard</span>
          </a>
        </li>

        <!-- System Tools & Maintenance (NEW: Web Installer & Artisan Runner) -->
        <li class="nav-item {{ request()->routeIs('system_tools.*') ? 'active' : '' }}">
          <a href="{{ route('system_tools.index') }}" class="nav-link text-warning" data-tooltip="System Tools">
            <i class="nav-icon fa fa-cogs"></i>
            <span class="nav-title"><b>System Tools</b> <span class="badge bg-warning text-dark ms-1">Migrate/Clear</span></span>
          </a>
        </li>

        <!-- Billing -->
        <li class="nav-item {{ request()->routeIs('billing.*') ? 'active' : '' }}">
          <a href="{{ route('billing.index') }}" class="nav-link" data-tooltip="Billing">
            <i class="nav-icon fa fa-file-invoice-dollar"></i>
            <span class="nav-title">Billing</span>
          </a>
        </li>

        <!-- Appointment -->
        <li class="nav-item {{ request()->routeIs('appointments.*') ? 'active' : '' }}">
          <a href="{{ route('appointments.index') }}" class="nav-link" data-tooltip="Appointment">
            <i class="nav-icon fa fa-calendar-check"></i>
            <span class="nav-title">Appointment</span>
          </a>
        </li>

        <!-- OPD - Out Patient -->
        <li class="nav-item {{ request()->routeIs('opd.*') ? 'active' : '' }}">
          <a href="{{ route('opd.index') }}" class="nav-link" data-tooltip="OPD - Out Patient">
            <i class="nav-icon fa fa-stethoscope"></i>
            <span class="nav-title">OPD - Out Patient</span>
          </a>
        </li>

        <!-- IPD - In Patient -->
        <li class="nav-item {{ request()->routeIs('ipd.*') ? 'active' : '' }}">
          <a href="{{ route('ipd.index') }}" class="nav-link" data-tooltip="IPD - In Patient">
            <i class="nav-icon fa fa-bed"></i>
            <span class="nav-title">IPD - In Patient</span>
          </a>
        </li>

        <!-- Pharmacy -->
        <li class="nav-item {{ request()->routeIs('pharmacy.*') ? 'active' : '' }}">
          <a href="{{ route('pharmacy.index') }}" class="nav-link" data-tooltip="Pharmacy">
            <i class="nav-icon fa fa-mortar-pestle"></i>
            <span class="nav-title">Pharmacy</span>
          </a>
        </li>

        <!-- Pathology -->
        <li class="nav-item {{ request()->routeIs('pathology.*') ? 'active' : '' }}">
          <a href="{{ route('pathology.index') }}" class="nav-link" data-tooltip="Pathology">
            <i class="nav-icon fa fa-flask"></i>
            <span class="nav-title">Pathology</span>
          </a>
        </li>

        <!-- Radiology -->
        <li class="nav-item {{ request()->routeIs('radiology.*') ? 'active' : '' }}">
          <a href="{{ route('radiology.index') }}" class="nav-link" data-tooltip="Radiology">
            <i class="nav-icon fa fa-microscope"></i>
            <span class="nav-title">Radiology</span>
          </a>
        </li>

        <!-- Blood Bank -->
        <li class="nav-item {{ request()->routeIs('blood_bank.*') ? 'active' : '' }}">
          <a href="{{ route('blood_bank.index') }}" class="nav-link" data-tooltip="Blood Bank">
            <i class="nav-icon fa fa-tint"></i>
            <span class="nav-title">Blood Bank</span>
          </a>
        </li>

        <!-- Human Resource -->
        <li class="nav-item {{ request()->routeIs('staff.*') ? 'active' : '' }}">
          <a href="{{ route('staff.index') }}" class="nav-link" data-tooltip="Human Resource">
            <i class="nav-icon fa fa-sitemap"></i>
            <span class="nav-title">Human Resource</span>
          </a>
        </li>

        <!-- Settings -->
        <li class="nav-item {{ request()->routeIs('settings.*') ? 'active' : '' }}">
          <a href="{{ route('settings.index') }}" class="nav-link" data-tooltip="Setup">
            <i class="nav-icon fa fa-sliders"></i>
            <span class="nav-title">Setup / Settings</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>

<!-- ═══════════════════ TOP BAR ═══════════════════ -->
<header class="topbar">
  <!-- Sidebar toggle (hamburger) -->
  <button type="button" class="tb-toggle" id="sidebarToggle" title="Toggle sidebar">
    <i class="fa fa-bars"></i>
  </button>

  <div class="tb-module">
    <span class="tb-module-name">Smart Hospital Management System</span>
  </div>

  <div class="tb-right ms-auto d-flex align-items-center gap-2">
    <!-- Live Console Quick Shortcut -->
    <a href="{{ route('system_tools.index') }}" class="btn btn-sm btn-outline-warning text-dark fw-bold px-2 py-1" title="System Tools">
      <i class="fa fa-terminal"></i> <span class="d-none d-md-inline">Console</span>
    </a>

    <!-- User Profile Dropdown -->
    <div class="dropdown">
      <button class="btn btn-sm dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
        <img src="{{ asset('backend/images/default.jpg') }}" alt="User" class="rounded-circle" width="30" height="30">
        <span class="d-none d-md-inline fw-semibold">{{ auth()->check() ? auth()->user()->full_name : 'Admin' }}</span>
      </button>
      <ul class="dropdown-menu dropdown-menu-end shadow-sm">
        <li><h6 class="dropdown-header">{{ auth()->check() ? auth()->user()->email : 'admin@smart-hospital.com' }}</h6></li>
        <li><a class="dropdown-item" href="{{ route('system_tools.index') }}"><i class="fa fa-cogs me-2"></i> System Tools</a></li>
        <li><hr class="dropdown-divider"></li>
        <li>
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="dropdown-item text-danger"><i class="fa fa-sign-out me-2"></i> Logout</button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</header>

<!-- ═══════════════════ MAIN CONTENT AREA ═══════════════════ -->
<main class="content-wrapper p-3 p-md-4">
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @yield('content')
</main>

<!-- Bootstrap 5 Bundle JS -->
<script src="{{ asset('backend/bootstrap5/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('backend/toast-alert/toastr.js') }}"></script>

<!-- Sidebar Toggle JS -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  var btn = document.getElementById('sidebarToggle');
  if (btn) {
    btn.addEventListener('click', function() {
      if (window.matchMedia('(max-width: 768px)').matches) {
        document.body.classList.toggle('sidebar-mobile-open');
      } else {
        var collapsed = document.body.classList.toggle('sidebar-collapsed');
        localStorage.setItem('sh_sidebar_collapsed', collapsed ? '1' : '0');
      }
    });
  }
});
</script>

@stack('scripts')
</body>
</html>
