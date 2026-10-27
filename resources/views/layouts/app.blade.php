<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'HICON IMPORT – Proformas')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --hicon-blue: #0b60a8;
            --hicon-cyan: #1db6e8;
            --hicon-light: #e8f4fc;
            --hicon-dark: #083b67;
            --hicon-gray: #6c757d;
            --hicon-border: #dbe4ee;
            --hicon-bg: #f4f7fb;
            --sidebar-width: 270px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            background:
                radial-gradient(circle at 80% 10%, rgba(29, 182, 232, 0.15), transparent 25%),
                radial-gradient(circle at 20% 90%, rgba(11, 96, 168, 0.15), transparent 30%),
                linear-gradient(135deg, #eef5fb, #dbeafe);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #1f2937;
        }

        .app-shell {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, #0a4f8e 0%, #0b60a8 55%, #1498cd 100%);
            color: #fff;
            padding: 1.35rem 1rem;
            box-shadow: 8px 0 30px rgba(8, 59, 103, 0.18);
            position: sticky;
            top: 0;
            height: 100vh;
            z-index: 1030;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            text-decoration: none;
            color: #fff;
            margin-bottom: 1.75rem;
            padding: 0.5rem 0.5rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.14);
        }

        .sidebar-brand img {
            width: 40px;
            height: 40px;
            object-fit: contain;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.14);
            padding: 4px;
        }

        .sidebar-brand-title {
            font-weight: 800;
            font-size: 1.05rem;
            line-height: 1.1;
            letter-spacing: 0.3px;
        }

        .sidebar-brand-subtitle {
            font-size: 0.76rem;
            opacity: 0.8;
        }

        .sidebar-section-title {
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            opacity: 0.8;
            margin: 0.25rem 0 0.85rem;
            padding: 0 0.65rem;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 0.45rem;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            text-decoration: none;
            color: rgba(255, 255, 255, 0.92);
            padding: 0.88rem 1rem;
            border-radius: 16px;
            font-weight: 600;
            transition: all 0.25s ease;
            position: relative;
        }

        .sidebar-link i {
            font-size: 1.05rem;
        }

        .sidebar-link:hover {
            background: rgba(255, 255, 255, 0.14);
            color: #fff;
            transform: translateX(4px);
        }

        .sidebar-link.active {
            background: #fff;
            color: var(--hicon-blue);
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.14);
        }

        .sidebar-link.active::before {
            content: "";
            position: absolute;
            left: -1rem;
            width: 4px;
            height: 28px;
            border-radius: 999px;
            background: #fff;
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 1rem 0.65rem 0;
            font-size: 0.8rem;
            opacity: 0.82;
        }

        .content-area {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background: rgba(255, 255, 255, 0.72);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.5);
            padding: 1rem 1.5rem;
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        .topbar-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .topbar-title {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--hicon-dark);
            margin: 0;
        }

        .topbar-subtitle {
            font-size: 0.86rem;
            color: #64748b;
            margin: 0;
        }

        .mobile-menu-btn {
            display: none;
        }

        .page-content {
            padding: 1.5rem;
        }

        .card-hicon,
        .btn,
        .table tbody tr,
        .badge,
        .form-control,
        .form-select {
            transition: all 0.25s ease;
        }

        .card-hicon {
            position: relative;
            background: rgba(255, 255, 255, 0.68);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.45);
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(15, 23, 42, 0.08);
            overflow: hidden;
        }

        .card-hicon:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.12);
        }

        .card-hicon .card-header {
            background: linear-gradient(135deg, var(--hicon-blue), var(--hicon-cyan));
            color: #fff;
            font-weight: 600;
            letter-spacing: 0.4px;
            border: none;
            padding: 1rem 1.25rem;
        }

        .btn-hicon {
            background: linear-gradient(135deg, var(--hicon-blue), var(--hicon-cyan));
            color: #fff;
            border: none;
            border-radius: 999px;
            padding: 0.62rem 1.25rem;
            font-weight: 700;
            box-shadow: 0 8px 20px rgba(11, 96, 168, 0.16);
        }

        .btn-hicon:hover {
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(11, 96, 168, 0.22);
        }

        .table-proforma tbody tr:hover {
            background: var(--hicon-light);
        }

        .item-row {
            background: #fff;
            border: 1px solid #edf2f7;
            border-radius: 14px;
            padding: 14px 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
            margin-bottom: 12px;
        }

        .total-box {
            background: linear-gradient(135deg, var(--hicon-blue), var(--hicon-cyan));
            color: #fff;
            border-radius: 14px;
            padding: 16px 24px;
            box-shadow: 0 6px 18px rgba(11, 96, 168, 0.18);
        }

        .badge-estado {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 115px;
            padding: 0.45rem 0.9rem;
            border-radius: 999px;
            font-size: 0.82rem;
            font-weight: 700;
        }

        .badge-pendiente {
            background: #ffe082;
            color: #7a5600;
        }

        .badge-rechazado {
            background: #ffd6db;
            color: #b42318;
        }

        .badge-aprobado {
            background: #d1f4df;
            color: #137a45;
        }

        .form-control,
        .form-select,
        textarea {
            border-radius: 12px;
            border: 1px solid var(--hicon-border);
        }

        .form-control:focus,
        .form-select:focus,
        textarea:focus {
            border-color: var(--hicon-cyan);
            box-shadow: 0 0 0 0.2rem rgba(29, 182, 232, 0.15);
        }

        .form-label {
            font-weight: 600;
            color: #334155;
            margin-bottom: 0.45rem;
        }

        .page-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--hicon-dark);
            margin-bottom: 0.25rem;
        }

        .page-subtitle {
            color: var(--hicon-gray);
            font-size: 0.95rem;
        }

        .alert {
            border: none;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                position: fixed;
                left: -100%;
                transition: left 0.28s ease;
                width: 280px;
            }

            .sidebar.show {
                left: 0;
            }

            .content-area {
                width: 100%;
            }

            .mobile-menu-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 42px;
                height: 42px;
                border-radius: 12px;
                border: none;
                background: #fff;
                color: var(--hicon-blue);
                box-shadow: 0 6px 18px rgba(15, 23, 42, 0.08);
            }

            .page-content {
                padding: 1rem;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    <div class="app-shell">
        <aside class="sidebar" id="sidebarMenu">
            <a href="{{ route('dashboard') }}" class="sidebar-brand">
                <img src="{{ asset('images/logoweb.png') }}" alt="Logo">
                <div>
                    <div class="sidebar-brand-title">HICON GROUP</div>
                    <div class="sidebar-brand-subtitle">Panel de gestión</div>
                </div>
            </a>

            <div class="sidebar-section-title">Menú principal</div>

            <nav class="sidebar-nav">
                <a href="{{ route('dashboard') }}"
                   class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('proformas.index') }}"
                   class="sidebar-link {{ request()->routeIs('proformas.index') || request()->routeIs('proformas.show') || request()->routeIs('proformas.edit') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Lista de Proformas</span>
                </a>

                <a href="{{ route('proformas.create') }}"
                   class="sidebar-link {{ request()->routeIs('proformas.create') ? 'active' : '' }}">
                    <i class="bi bi-plus-circle"></i>
                    <span>Nueva Proforma</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <div><strong>HICON GROUP</strong></div>
                <div>Sistema interno de proformas</div>
            </div>
        </aside>

        <div class="content-area">
            <header class="topbar">
                <div class="topbar-inner">
                    <div class="d-flex align-items-center gap-3">
                        <button class="mobile-menu-btn" type="button" id="toggleSidebar">
                            <i class="bi bi-list"></i>
                        </button>

                        <div>
                            <h2 class="topbar-title">Panel Administrativo</h2>
                            <p class="topbar-subtitle">Gestión comercial y control de proformas</p>
                        </div>
                    </div>

                    <div class="d-none d-md-flex align-items-center gap-2">
                        <span class="badge bg-light text-primary rounded-pill px-3 py-2">
                            <i class="bi bi-shield-check me-1"></i> Sistema activo
                        </span>
                    </div>
                </div>
            </header>

            <main class="page-content">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm mb-4" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm mb-4" role="alert">
                        <i class="bi bi-x-circle-fill me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebarMenu');
            const toggleBtn = document.getElementById('toggleSidebar');

            if (toggleBtn && sidebar) {
                toggleBtn.addEventListener('click', function () {
                    sidebar.classList.toggle('show');
                });
            }
        });
    </script>

    @stack('scripts')
</body>

</html>