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
/* Sidebar collapsed-state restore */
(function(){try{if(localStorage.getItem('sh_sidebar_collapsed')==='1'){document.body.classList.add('sidebar-collapsed');}}catch(e){}})();
</script>

<!-- ═══════════════════ SIDEBAR ═══════════════════ -->
<nav class="sh-sidebar" id="sidebar">
  <!-- Brand logo -->
  <div class="sh-sidebar-brand">
    <a href="{{ route('admin.dashboard') }}" class="sh-sidebar-logo">
      <img src="{{ asset('backend/images/s_logo.png') }}" alt="Logo" class="sh-sidebar-logo-img">
      <span class="sh-sidebar-name">Smart Hospital</span>
    </a>
  </div>

  <!-- Menu filter -->
  <div class="sh-sidebar-search">
    <div class="input-group input-group-sm">
      <span class="input-group-text"><i class="fa fa-search"></i></span>
      <input type="text" id="sidebar-menu-filter" class="form-control" placeholder="Search menu..." autocomplete="off">
    </div>
  </div>

  <!-- Navigation menu -->
  <div class="sh-sidebar-scroll">
    <ul class="sh-nav" id="sh-sidenav">
      <li class="sh-section">CORE OPERATIONS</li>

      <!-- Dashboard -->
      <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
          <i class="fas fa-television"></i> <span>Dashboard</span>
        </a>
      </li>

      <!-- System Tools & Live Maintenance -->
      <li class="nav-item {{ request()->routeIs('system_tools.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('system_tools.index') }}" style="color: #f59e0b !important;">
          <i class="fas fa-cogs" style="color: #f59e0b;"></i> <span>System Tools</span>
        </a>
      </li>

      <!-- Billing -->
      <li class="nav-item {{ request()->routeIs('billing.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('billing.index') }}">
          <i class="fas fa-file-invoice"></i> <span>Billing</span>
        </a>
      </li>

      <!-- Appointment -->
      <li class="nav-item {{ request()->routeIs('appointments.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('appointments.index') }}">
          <i class="fa fa-calendar-check-o"></i> <span>Appointment</span>
        </a>
      </li>

      <!-- OPD - Out Patient -->
      <li class="nav-item {{ request()->routeIs('opd.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('opd.index') }}">
          <i class="fas fa-stethoscope"></i> <span>OPD - Out Patient</span>
        </a>
      </li>

      <!-- IPD - In Patient -->
      <li class="nav-item {{ request()->routeIs('ipd.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('ipd.index') }}">
          <i class="fas fa-bed"></i> <span>IPD - In Patient</span>
        </a>
      </li>

      <!-- Pharmacy -->
      <li class="nav-item {{ request()->routeIs('pharmacy.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pharmacy.index') }}">
          <i class="fas fa-mortar-pestle"></i> <span>Pharmacy</span>
        </a>
      </li>

      <!-- Pathology -->
      <li class="nav-item {{ request()->routeIs('pathology.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pathology.index') }}">
          <i class="fas fa-flask"></i> <span>Pathology</span>
        </a>
      </li>

      <!-- Radiology -->
      <li class="nav-item {{ request()->routeIs('radiology.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('radiology.index') }}">
          <i class="fas fa-microscope"></i> <span>Radiology</span>
        </a>
      </li>

      <!-- Blood Bank -->
      <li class="nav-item {{ request()->routeIs('blood_bank.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('blood_bank.index') }}">
          <i class="fas fa-tint"></i> <span>Blood Bank</span>
        </a>
      </li>

      <!-- Human Resource -->
      <li class="nav-item {{ request()->routeIs('staff.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('staff.index') }}">
          <i class="fas fa-sitemap"></i> <span>Human Resource</span>
        </a>
      </li>

      <!-- Settings -->
      <li class="nav-item {{ request()->routeIs('settings.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('settings.index') }}">
          <i class="fas fa-sliders-h"></i> <span>Setup / Settings</span>
        </a>
      </li>
    </ul>
  </div>
</nav>

<!-- ═══════════════════ TOP BAR ═══════════════════ -->
<header class="topbar">
  <!-- Sidebar toggle (hamburger) -->
  <button type="button" class="tb-toggle" id="sidebarToggle" title="Toggle sidebar">
    <i class="fa fa-bars"></i>
  </button>

  <div class="tb-module">
    <div class="ic"><i class="fa fa-hospital-o"></i></div>
    Smart Hospital Management
  </div>

  <div class="sh-tb-flex-spacer"></div>

  <!-- Right actions -->
  <div class="tb-rail">
    <!-- Quick System Tools Button -->
    <a href="{{ route('system_tools.index') }}" class="tb-btn" title="Live Database Migration & Console">
      <i class="fa fa-cogs" style="color: #f59e0b;"></i>
    </a>

    <!-- User signet -->
    <div class="dropdown">
      <a class="tb-signet" href="#" data-bs-toggle="dropdown">
        <img src="{{ asset('backend/images/default.jpg') }}" alt="User">
        <div class="tb-signet-text">
          <span class="tb-signet-name">{{ auth()->check() ? auth()->user()->full_name : 'Super Admin' }}</span>
          <span class="tb-signet-role">Admin</span>
        </div>
        <i class="fa fa-angle-down"></i>
      </a>
      <ul class="dropdown-menu dropdown-menu-end sh-tb-dropdown-user">
        <li class="px-3 py-2 border-bottom">
          <div class="fw-bold">{{ auth()->check() ? auth()->user()->full_name : 'Super Admin' }}</div>
          <div class="text-muted small">{{ auth()->check() ? auth()->user()->email : 'admin@smart-hospital.com' }}</div>
        </li>
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
<main class="content">
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
      <i class="fa fa-check-circle me-1"></i> {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
      <i class="fa fa-exclamation-circle me-1"></i> {{ session('error') }}
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

  // Quick filter for sidebar menu
  var filterInput = document.getElementById('sidebar-menu-filter');
  if (filterInput) {
    filterInput.addEventListener('keyup', function() {
      var val = this.value.toLowerCase();
      var items = document.querySelectorAll('#sh-sidenav .nav-item');
      items.forEach(function(item) {
        var text = item.textContent.toLowerCase();
        item.style.display = text.indexOf(val) > -1 ? '' : 'none';
      });
    });
  }
});
</script>

@stack('scripts')
</body>
</html>
