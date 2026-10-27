@extends('layouts.app')

@section('title', 'Dashboard – HICON IMPORT')

@push('styles')
<style>
    .dashboard-hero {
        background: linear-gradient(135deg, #0b60a8, #1db6e8);
        border-radius: 24px;
        padding: 1.6rem;
        color: #fff;
        box-shadow: 0 14px 36px rgba(11, 96, 168, 0.20);
        position: relative;
        overflow: hidden;
    }

    .dashboard-hero::before {
        content: "";
        position: absolute;
        top: -40px;
        right: -30px;
        width: 180px;
        height: 180px;
        background: rgba(255, 255, 255, 0.10);
        border-radius: 50%;
    }

    .dashboard-hero::after {
        content: "";
        position: absolute;
        bottom: -55px;
        left: -40px;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.07);
        border-radius: 50%;
    }

    .dashboard-hero h1,
    .dashboard-hero p,
    .dashboard-hero .btn {
        position: relative;
        z-index: 1;
    }

    .dashboard-hero-title {
        font-size: 1.9rem;
        font-weight: 800;
        margin-bottom: 0.35rem;
    }

    .dashboard-hero-subtitle {
        margin-bottom: 0;
        opacity: 0.95;
        max-width: 760px;
    }

    .metric-card {
        border: none;
        border-radius: 22px;
        overflow: hidden;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.08);
        transition: all 0.25s ease;
        height: 100%;
    }

    .metric-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 34px rgba(11, 96, 168, 0.14);
    }

    .metric-card .card-body {
        padding: 1.2rem;
    }

    .metric-icon {
        width: 58px;
        height: 58px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 1.4rem;
        flex-shrink: 0;
    }

    .metric-blue {
        background: linear-gradient(135deg, #0b60a8, #1d7ed6);
    }

    .metric-cyan {
        background: linear-gradient(135deg, #1db6e8, #59d4f4);
    }

    .metric-green {
        background: linear-gradient(135deg, #198754, #34c37c);
    }

    .metric-amber {
        background: linear-gradient(135deg, #f0ad00, #ffc107);
    }

    .metric-red {
        background: linear-gradient(135deg, #dc3545, #ff6b81);
    }

    .metric-dark {
        background: linear-gradient(135deg, #083b67, #0b60a8);
    }

    .metric-label {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        font-weight: 700;
        margin-bottom: 0.2rem;
    }

    .metric-value {
        font-size: 1.45rem;
        font-weight: 800;
        color: #0b60a8;
        line-height: 1.1;
    }

    .metric-note {
        font-size: 0.8rem;
        color: #94a3b8;
        margin-top: 0.2rem;
    }

    .dashboard-card {
        border: none;
        border-radius: 22px;
        overflow: hidden;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.07);
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(8px);
    }

    .dashboard-card .card-header {
        background: linear-gradient(135deg, #0b60a8, #1db6e8);
        color: #fff;
        font-weight: 700;
        border: none;
        padding: 1rem 1.2rem;
    }

    .quick-link {
        display: flex;
        align-items: center;
        gap: 0.9rem;
        text-decoration: none;
        color: #1f2937;
        background: #fff;
        border: 1px solid #e5edf5;
        border-radius: 18px;
        padding: 1rem 1rem;
        box-shadow: 0 6px 18px rgba(15, 23, 42, 0.05);
        transition: all 0.25s ease;
        height: 100%;
    }

    .quick-link:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 24px rgba(11, 96, 168, 0.12);
        border-color: #cfe7f7;
        color: #0b60a8;
    }

    .quick-link-icon {
        width: 50px;
        height: 50px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #0b60a8, #1db6e8);
        color: #fff;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .quick-link-title {
        font-weight: 800;
        margin-bottom: 0.15rem;
    }

    .quick-link-text {
        font-size: 0.88rem;
        color: #64748b;
        margin: 0;
    }

    .table-dashboard th {
        font-size: 0.76rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        border-bottom-width: 1px;
    }

    .table-dashboard td {
        vertical-align: middle;
        padding-top: 0.85rem;
        padding-bottom: 0.85rem;
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 100px;
        padding: 0.42rem 0.8rem;
        border-radius: 999px;
        font-size: 0.76rem;
        font-weight: 700;
    }

    .status-pendiente {
        background: #ffe082;
        color: #7a5600;
    }

    .status-aprobado {
        background: #d1f4df;
        color: #137a45;
    }

    .status-rechazado {
        background: #ffd6db;
        color: #b42318;
    }

    .empty-box {
        padding: 2rem 1rem;
        text-align: center;
        color: #64748b;
    }

    .empty-box i {
        font-size: 2.4rem;
        color: #9db8d3;
        display: block;
        margin-bottom: 0.8rem;
    }

    .chart-container {
        width: 100%;
        max-width: 240px;
        height: 240px;
        margin: 0 auto;
        position: relative;
    }
</style>
@endpush

@section('content')
<div class="dashboard-hero mb-4">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
        <div>
            <h1 class="dashboard-hero-title">
                <i class="bi bi-speedometer2 me-2"></i>Dashboard
            </h1>
            <p class="dashboard-hero-subtitle">
                Visualiza el estado general de tus proformas, el rendimiento comercial y accede rápidamente a las funciones principales del sistema.
            </p>
        </div>

        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('proformas.create') }}" class="btn btn-light rounded-pill px-4">
                <i class="bi bi-plus-lg me-1"></i> Nueva Proforma
            </a>
            <a href="{{ route('proformas.index') }}" class="btn btn-outline-light rounded-pill px-4">
                <i class="bi bi-list-ul me-1"></i> Ver Proformas
            </a>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-6 col-xl-3">
        <div class="card metric-card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="metric-icon metric-blue">
                    <i class="bi bi-files"></i>
                </div>
                <div>
                    <div class="metric-label">Total Proformas</div>
                    <div class="metric-value">{{ $kpis['total'] }}</div>
                    <div class="metric-note">Registros acumulados</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card metric-card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="metric-icon metric-amber">
                    <i class="bi bi-hourglass-split"></i>
                </div>
                <div>
                    <div class="metric-label">Pendientes</div>
                    <div class="metric-value">{{ $kpis['pendientes'] }}</div>
                    <div class="metric-note">Esperando decisión</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card metric-card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="metric-icon metric-green">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div>
                    <div class="metric-label">Aprobadas</div>
                    <div class="metric-value">{{ $kpis['aprobadas'] }}</div>
                    <div class="metric-note">Cerradas con éxito</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card metric-card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="metric-icon metric-red">
                    <i class="bi bi-x-circle"></i>
                </div>
                <div>
                    <div class="metric-label">Rechazadas</div>
                    <div class="metric-value">{{ $kpis['rechazadas'] }}</div>
                    <div class="metric-note">No concretadas</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="card metric-card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="metric-icon metric-cyan">
                    <i class="bi bi-cash-stack"></i>
                </div>
                <div>
                    <div class="metric-label">Ventas Totales</div>
                    <div class="metric-value">S/ {{ number_format($kpis['ventas_totales'], 2) }}</div>
                    <div class="metric-note">Solo proformas aprobadas</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="card metric-card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="metric-icon metric-dark">
                    <i class="bi bi-calendar2-week"></i>
                </div>
                <div>
                    <div class="metric-label">Ventas del Mes</div>
                    <div class="metric-value">S/ {{ number_format($kpis['ventas_mes'], 2) }}</div>
                    <div class="metric-note">Mes actual</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="card metric-card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="metric-icon metric-blue">
                    <i class="bi bi-calendar-day"></i>
                </div>
                <div>
                    <div class="metric-label">Hoy</div>
                    <div class="metric-value">{{ $kpis['proformas_hoy'] }}</div>
                    <div class="metric-note">Emitidas hoy</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="card metric-card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="metric-icon metric-green">
                    <i class="bi bi-graph-up-arrow"></i>
                </div>
                <div>
                    <div class="metric-label">Conversión</div>
                    <div class="metric-value">{{ $kpis['conversion'] }}%</div>
                    <div class="metric-note">Aprobadas / total</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4 align-items-stretch">
    <div class="col-lg-4 d-flex">
        <div class="card dashboard-card w-100">
            <div class="card-header">
                <i class="bi bi-pie-chart me-2"></i>Estado de Proformas
            </div>
            <div class="card-body d-flex justify-content-center align-items-center">
                <div class="chart-container">
                    <canvas id="chartEstados"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8 d-flex">
        <div class="card dashboard-card w-100">
            <div class="card-header">
                <i class="bi bi-bar-chart-line me-2"></i>Actividad mensual
            </div>
            <div class="card-body">
                <canvas id="chartMeses" height="140"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-4">
        <a href="{{ route('proformas.create') }}" class="quick-link">
            <div class="quick-link-icon">
                <i class="bi bi-plus-circle"></i>
            </div>
            <div>
                <div class="quick-link-title">Crear nueva proforma</div>
                <p class="quick-link-text">Genera una cotización nueva de forma rápida.</p>
            </div>
        </a>
    </div>

    <div class="col-lg-4">
        <a href="{{ route('proformas.index') }}" class="quick-link">
            <div class="quick-link-icon">
                <i class="bi bi-list-ul"></i>
            </div>
            <div>
                <div class="quick-link-title">Ver listado completo</div>
                <p class="quick-link-text">Consulta, filtra y administra todas las proformas.</p>
            </div>
        </a>
    </div>

    <div class="col-lg-4">
        <a href="{{ route('proformas.index', ['estado' => 'pendiente']) }}" class="quick-link">
            <div class="quick-link-icon">
                <i class="bi bi-funnel"></i>
            </div>
            <div>
                <div class="quick-link-title">Revisar pendientes</div>
                <p class="quick-link-text">Accede rápido a las proformas por atender.</p>
            </div>
        </a>
    </div>
</div>

<div class="card dashboard-card">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <span><i class="bi bi-clock-history me-2"></i>Últimas Proformas Registradas</span>

        <a href="{{ route('proformas.index') }}" class="btn btn-light btn-sm rounded-pill px-3">
            Ver todas
        </a>
    </div>

    <div class="card-body">
        @if($ultimasProformas->count())
        <div class="table-responsive">
            <table class="table table-dashboard align-middle mb-0">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Moneda</th>
                        <th class="text-end">Total</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ultimasProformas as $proforma)
                    <tr>
                        <td class="fw-bold text-primary">{{ $proforma->numero }}</td>
                        <td>{{ $proforma->cliente_nombre ?: '—' }}</td>
                        <td>{{ $proforma->fecha?->format('d/m/Y') ?? '—' }}</td>
                        <td>{{ $proforma->moneda }}</td>
                        <td class="text-end fw-bold">
                            {{ $proforma->moneda === 'USD' ? '$' : 'S/' }}
                            {{ number_format($proforma->total, 2) }}
                        </td>
                        <td class="text-center">
                            <span class="status-pill status-{{ $proforma->estado }}">
                                {{ ucfirst($proforma->estado) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('proformas.show', $proforma) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                Ver
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="empty-box">
            <i class="bi bi-inbox"></i>
            Aún no hay proformas registradas.
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const estadosCanvas = document.getElementById('chartEstados');
    const mesesCanvas = document.getElementById('chartMeses');

    if (estadosCanvas && typeof Chart !== 'undefined') {
        new Chart(estadosCanvas, {
            type: 'doughnut',
            data: {
                labels: ['Pendientes', 'Aprobadas', 'Rechazadas'],
                datasets: [{
                    data: [
                        {{ $graficoEstados['pendientes'] ?? 0 }},
                        {{ $graficoEstados['aprobadas'] ?? 0 }},
                        {{ $graficoEstados['rechazadas'] ?? 0 }}
                    ],
                    backgroundColor: ['#ffc107', '#198754', '#dc3545'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 12,
                            padding: 15
                        }
                    }
                }
            }
        });
    }

    if (mesesCanvas && typeof Chart !== 'undefined') {
        new Chart(mesesCanvas, {
            type: 'bar',
            data: {
                labels: @json($labelsMeses ?? []),
                datasets: [{
                    label: 'Proformas',
                    data: @json($datosMeses ?? []),
                    backgroundColor: '#0b60a8',
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    }
});
</script>
@endpush