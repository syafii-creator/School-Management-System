<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDUDASH - School Management System</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --sidebar-width: 260px;
            --bg-main: #f8fafc;
            --sidebar-bg: #0f172a;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-main);
            color: #334155;
            min-height: 100vh;
        }
        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background-color: var(--sidebar-bg);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }
        .sidebar .brand-title {
            font-size: 1.35rem;
            font-weight: 800;
            color: #ffffff;
            padding: 24px 20px;
            letter-spacing: 0.5px;
        }
        .sidebar .nav-link {
            color: #94a3b8;
            padding: 12px 20px;
            margin: 4px 16px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.25s ease;
        }
        .sidebar .nav-link:hover {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.08);
            transform: translateX(3px);
        }
        .sidebar .nav-link.active {
            color: #ffffff;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);
        }
        .wrapper-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .topbar {
            height: 70px;
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0 35px;
        }
        .main-content {
            padding: 35px;
            flex: 1;
        }
        .card-stat {
            border: none;
            border-radius: 16px;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        }
        .card-stat:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.07);
        }
        .icon-box {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
        }
    </style>
</head>
<body>

<!-- Left Sidebar Navigation -->
<aside class="sidebar d-flex flex-column justify-content-between">
    <div>
        <div class="brand-title d-flex align-items-center gap-2">
            <div class="bg-primary rounded-3 p-1 d-flex align-items-center justify-content-center" style="width:32px; height:32px;">
                <i class="bi bi-mortarboard-fill text-white fs-6"></i>
            </div>
            EDUDASH
        </div>

        <div class="px-3 mb-2 text-uppercase text-muted fw-bold" style="font-size: 0.7rem; letter-spacing: 1px;">MAIN MENU</div>

        <ul class="nav flex-column mb-auto">
            <li>
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2-fill"></i> Dashboard
                </a>
            </li>

            {{-- MENU KHUSUS ADMIN --}}
            @if(auth()->user()->role === 'admin')
                <li>
                    <a href="{{ route('students.index') }}" class="nav-link {{ request()->routeIs('students.*') ? 'active' : '' }}">
                        <i class="bi bi-people-fill"></i> Student Data
                    </a>
                </li>
                <li>
                    <a href="{{ route('teachers.index') }}" class="nav-link {{ request()->routeIs('teachers.*') ? 'active' : '' }}">
                        <i class="bi bi-person-badge-fill"></i> Teacher Data
                    </a>
                </li>
                <li>
                    <a href="{{ route('classes.index') }}" class="nav-link {{ request()->routeIs('classes.*') ? 'active' : '' }}">
                        <i class="bi bi-door-open-fill"></i> Class Data
                    </a>
                </li>
                <li>
                    <a href="{{ route('subjects.index') }}" class="nav-link {{ request()->routeIs('subjects.*') ? 'active' : '' }}">
                        <i class="bi bi-journal-bookmark-fill"></i> Subject Data
                    </a>
                </li>
                <li>
                    <a href="{{ route('school.index') }}" class="nav-link {{ request()->routeIs('school.*') ? 'active' : '' }}">
                        <i class="bi bi-building-fill"></i> School Data
                    </a>
                </li>

            {{-- MENU KHUSUS TEACHER --}}
            @elseif(auth()->user()->role === 'teacher')
                <li>
                    <a href="{{ route('students.index') }}" class="nav-link {{ request()->routeIs('students.*') ? 'active' : '' }}">
                        <i class="bi bi-people-fill"></i> Student Data
                    </a>
                </li>
                <li>
                    <a href="{{ route('classes.index') }}" class="nav-link {{ request()->routeIs('classes.*') ? 'active' : '' }}">
                        <i class="bi bi-door-open-fill"></i> Class Data
                    </a>
                </li>
                <li>
                    <a href="{{ route('subjects.index') }}" class="nav-link {{ request()->routeIs('subjects.*') ? 'active' : '' }}">
                        <i class="bi bi-journal-bookmark-fill"></i> Subject Data
                    </a>
                </li>
                <li>
                    <a href="{{ route('school.index') }}" class="nav-link {{ request()->routeIs('school.*') ? 'active' : '' }}">
                        <i class="bi bi-building-fill"></i> School Data
                    </a>
                </li>

            {{-- MENU KHUSUS STUDENT --}}
            @elseif(auth()->user()->role === 'student')
                <li>
                    <a href="{{ route('student.profile') }}" class="nav-link {{ request()->routeIs('student.profile') ? 'active' : '' }}">
                        <i class="bi bi-person-badge-fill"></i> My Profile
                    </a>
                </li>
                <li>
                    <a href="{{ route('student.my-class') }}" class="nav-link {{ request()->routeIs('student.my-class') ? 'active' : '' }}">
                        <i class="bi bi-door-open-fill"></i> My Class
                    </a>
                </li>
            @endif
        </ul>
    </div>

    <!-- Solid Blue Logout Button -->
    <div class="p-3 border-top border-secondary border-opacity-25">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2 py-2 rounded-3 fw-bold border-0 shadow-sm" style="background-color: #2563eb;">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>
</aside>

<!-- Main Content Wrapper -->
<div class="wrapper-content">
    <!-- Topbar Header -->
    <header class="topbar d-flex align-items-center justify-content-between">
        <div>
            <h6 class="mb-0 fw-bold text-dark">School Management System</h6>
            <small class="text-muted">Welcome back to the control panel</small>
        </div>

        <div class="d-flex align-items-center gap-3">
            <div class="text-end d-none d-sm-block">
                <div class="fw-bold text-dark small">{{ auth()->user()->username ?? 'User' }}</div>
                <span class="badge bg-primary-subtle text-primary text-uppercase px-2" style="font-size: 0.65rem;">{{ auth()->user()->role ?? 'Guest' }}</span>
            </div>
            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px;">
                {{ strtoupper(substr(auth()->user()->username ?? 'U', 0, 1)) }}
            </div>
        </div>
    </header>

    <!-- Main View Content -->
    <main class="main-content">
        <!-- Dynamic Breadcrumbs -->
        @hasSection('breadcrumb')
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb bg-white px-3 py-2.5 rounded-3 shadow-sm align-items-center mb-0" style="font-size: 0.875rem; border: 1px solid #e2e8f0;">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}" class="text-decoration-none text-primary fw-semibold d-inline-flex align-items-center gap-1">
                            <i class="bi bi-house-door-fill"></i> Dashboard
                        </a>
                    </li>
                    @yield('breadcrumb')
                </ol>
            </nav>
        @endif

        @yield('content')
    </main>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/bootstrap.bundle.min.js"></script>
</body>
</html>
