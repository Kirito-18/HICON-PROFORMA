@extends('layouts.app')

@section('title', 'Proformas – HICON IMPORT')

@push('styles')
<style>
    .hero-panel {
        background: linear-gradient(135deg, #0b60a8, #1db6e8);
        border-radius: 24px;
        padding: 1.5rem 1.5rem;
        color: #fff;
        box-shadow: 0 14px 34px rgba(11, 96, 168, 0.18);
        position: relative;
        overflow: hidden;
    }

    .hero-panel::before {
        content: "";
        position: absolute;
        top: -30px;
        right: -30px;
        width: 140px;
        height: 140px;
        background: rgba(255, 255, 255, 0.10);
        border-radius: 50%;
    }

    .hero-panel::after {
        content: "";
        position: absolute;
        bottom: -45px;
        left: -35px;
        width: 160px;
        height: 160px;
        background: rgba(255, 255, 255, 0.06);
        border-radius: 50%;
    }

    .hero-title {
        font-size: 1.75rem;
        font-weight: 800;
        margin-bottom: 0.35rem;
        position: relative;
        z-index: 1;
    }

    .hero-subtitle {
        margin-bottom: 0;
        opacity: 0.92;
        position: relative;
        z-index: 1;
    }

    .hero-actions {
        position: relative;
        z-index: 1;
    }

    .hero-actions .btn {
        border-radius: 999px;
        font-weight: 600;
        padding: 0.65rem 1.2rem;
    }

    .quick-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 8px 26px rgba(15, 23, 42, 0.07);
        transition: all 0.25s ease;
        overflow: hidden;
        height: 100%;
    }

    .quick-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 34px rgba(11, 96, 168, 0.14);
    }

    .quick-icon {
        width: 54px;
        height: 54px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
        color: #fff;
        flex-shrink: 0;
    }

    .quick-blue {
        background: linear-gradient(135deg, #0b60a8, #1d7ed6);
    }

    .quick-cyan {
        background: linear-gradient(135deg, #1db6e8, #59d4f4);
    }

    .quick-dark {
        background: linear-gradient(135deg, #084a82, #0b60a8);
    }

    .quick-label {
        font-size: 0.8rem;
        color: #64748b;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }

    .quick-value {
        font-size: 1.1rem;
        color: #0b60a8;
        font-weight: 800;
        line-height: 1.2;
    }

    .filter-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
        transition: all 0.25s ease;
    }

    .filter-card:hover {
        box-shadow: 0 12px 28px rgba(11, 96, 168, 0.10);
    }

    .filter-title {
        font-size: 1rem;
        font-weight: 700;
        color: #0b60a8;
        margin-bottom: 1rem;
    }

    .table-shell {
        border: none;
        border-radius: 22px;
        overflow: hidden;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.07);
    }

    .table-proforma thead th {
        font-size: 0.76rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        vertical-align: middle;
        background: linear-gradient(135deg, #0b60a8, #1db6e8);
        color: #fff;
        border: none;
        padding-top: 0.95rem;
        padding-bottom: 0.95rem;
    }

    .table-proforma tbody td {
        vertical-align: middle;
        padding-top: 0.9rem;
        padding-bottom: 0.9rem;
        border-color: #edf2f7;
    }

    .table-proforma tbody tr {
        transition: all 0.2s ease;
    }

    .table-proforma tbody tr:hover {
        background: #eef8ff;
    }

    .badge-estado {
        padding: 0.42rem 0.9rem;
        border-radius: 999px;
        font-size: 0.72rem;
        font-weight: 700;
        display: inline-block;
        min-width: 100px;
        text-align: center;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
    }

    .estado-select-clean {
        font-size: 0.75rem;
        border-radius: 10px;
        min-width: 132px;
        text-align: center;
        cursor: pointer;
    }

    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 0.4rem;
        flex-wrap: wrap;
    }

    .action-buttons .btn {
        border-radius: 10px;
        transition: all 0.2s ease;
    }

    .action-buttons .btn:hover {
        transform: translateY(-2px);
    }

    .total-highlight {
        color: #0b60a8;
        font-size: 1rem;
        font-weight: 800;
    }

    .number-pill {
        display: inline-block;
        background: #eaf6ff;
        color: #0b60a8;
        border-radius: 999px;
        padding: 0.35rem 0.75rem;
        font-weight: 700;
        font-size: 0.86rem;
    }

    .btn-hicon-strong {
        background: linear-gradient(135deg, #0b60a8, #1db6e8);
        color: #fff;
        border: none;
        border-radius: 999px;
        padding: 0.75rem 1.4rem;
        font-weight: 700;
        box-shadow: 0 10px 22px rgba(11, 96, 168, 0.18);
        transition: all 0.25s ease;
    }

    .btn-hicon-strong:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 14px 28px rgba(11, 96, 168, 0.24);
    }

    .btn-filter {
        border-radius: 12px;
        font-weight: 600;
    }

    .btn-clear {
        border-radius: 12px;
        font-weight: 600;
    }

    .empty-state {
        padding: 3rem 1rem;
    }

    .empty-state i {
        font-size: 2.8rem;
        color: #9db8d3;
    }
</style>
@endpush

@section('content')
<div class="hero-panel mb-4">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
        <div>
            <h1 class="hero-title">
                <i class="bi bi-file-earmark-text me-2"></i>Panel de Proformas
            </h1>
            <p class="hero-subtitle">
                Gestiona cotizaciones, controla estados y mantén todo ordenado con una vista clara y moderna.
            </p>
        </div>

        <div class="hero-actions">
            <a href="{{ route('proformas.create') }}" class="btn btn-light">
                <i class="bi bi-plus-lg me-1"></i> Nueva Proforma
            </a>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card quick-card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="quick-icon quick-blue">
                    <i class="bi bi-lightning-charge-fill"></i>
                </div>
                <div>
                    <div class="quick-label">Gestión rápida</div>
                    <div class="quick-value">Crea y edita proformas fácilmente</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card quick-card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="quick-icon quick-cyan">
                    <i class="bi bi-filetype-pdf"></i>
                </div>
                <div>
                    <div class="quick-label">PDF profesional</div>
                    <div class="quick-value">Genera y comparte documentos elegantes</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card quick-card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="quick-icon quick-dark">
                    <i class="bi bi-check2-circle"></i>
                </div>
                <div>
                    <div class="quick-label">Control de estados</div>
                    <div class="quick-value">Organiza pendientes, aprobadas y rechazadas</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card filter-card mb-4">
    <div class="card-body">
        <div class="filter-title">
            <i class="bi bi-funnel me-2"></i>Buscador y filtros
        </div>

        <form method="GET" action="{{ route('proformas.index') }}">
            <div class="row g-3 align-items-end">
                <div class="col-lg-4">
                    <label class="form-label">Buscar</label>
                    <input
                        type="text"
                        name="buscar"
                        class="form-control"
                        value="{{ request('buscar') }}"
                        placeholder="Cliente, número o DNI/RUC..."
                    >
                </div>

                <div class="col-lg-2">
                    <label class="form-label">Estado</label>
                    <select name="estado" class="form-select">
                        <option value="">Todos</option>
                        <option value="pendiente" {{ request('estado') === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="aprobado" {{ request('estado') === 'aprobado' ? 'selected' : '' }}>Aprobado</option>
                        <option value="rechazado" {{ request('estado') === 'rechazado' ? 'selected' : '' }}>Rechazado</option>
                    </select>
                </div>

                <div class="col-lg-2">
                    <label class="form-label">Fecha desde</label>
                    <input
                        type="date"
                        name="fecha_desde"
                        class="form-control"
                        value="{{ request('fecha_desde') }}"
                    >
                </div>

                <div class="col-lg-2">
                    <label class="form-label">Fecha hasta</label>
                    <input
                        type="date"
                        name="fecha_hasta"
                        class="form-control"
                        value="{{ request('fecha_hasta') }}"
                    >
                </div>

                <div class="col-lg-1 d-grid">
                    <button type="submit" class="btn btn-hicon btn-filter">
                        <i class="bi bi-search"></i>
                    </button>
                </div>

                <div class="col-lg-1 d-grid">
                    <a href="{{ route('proformas.index') }}" class="btn btn-outline-secondary btn-clear">
                        <i class="bi bi-arrow-clockwise"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card table-shell">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <span>
            <i class="bi bi-table me-2"></i>Listado de Proformas
        </span>

        <span class="badge bg-white text-primary rounded-pill px-3 py-2">
            {{ $proformas->total() }} registros
        </span>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-proforma mb-0 align-middle">
                <thead>
                    <tr>
                        <th>N° Proforma</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Moneda</th>
                        <th class="text-end">Total</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($proformas as $proforma)
                        <tr>
                            <td>
                                <span class="number-pill">{{ $proforma->numero }}</span>
                            </td>

                            <td>
                                <div class="fw-semibold">{{ $proforma->cliente_nombre ?: '—' }}</div>
                                @if($proforma->cliente_ruc)
                                    <small class="text-muted">{{ $proforma->cliente_ruc }}</small>
                                @endif
                            </td>

                            <td>{{ $proforma->fecha?->format('d/m/Y') ?? '—' }}</td>

                            <td>{{ $proforma->moneda }}</td>

                            <td class="text-end">
                                <span class="total-highlight">
                                    {{ $proforma->moneda === 'USD' ? '$' : 'S/' }}
                                    {{ number_format($proforma->total, 2) }}
                                </span>
                            </td>

                            <td class="text-center">
                                <div class="d-flex flex-column align-items-center gap-2">
                                    <span class="badge-estado badge-{{ $proforma->estado }}">
                                        {{ ucfirst($proforma->estado) }}
                                    </span>

                                    <form action="{{ route('proformas.estado', $proforma) }}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <select
                                            name="estado"
                                            onchange="this.form.submit()"
                                            class="form-select form-select-sm estado-select-clean"
                                        >
                                            @foreach(['pendiente', 'aprobado', 'rechazado'] as $estado)
                                                <option value="{{ $estado }}" @selected($proforma->estado === $estado)>
                                                    {{ ucfirst($estado) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </div>
                            </td>

                            <td class="text-center">
                                <div class="action-buttons">
                                    <a href="{{ route('proformas.show', $proforma) }}"
                                       class="btn btn-sm btn-outline-primary"
                                       title="Ver">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a href="{{ route('proformas.edit', $proforma) }}"
                                       class="btn btn-sm btn-outline-warning"
                                       title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <a href="{{ route('proformas.preview', $proforma) }}"
                                       class="btn btn-sm btn-outline-secondary"
                                       target="_blank"
                                       title="Vista previa PDF">
                                        <i class="bi bi-filetype-pdf"></i>
                                    </a>

                                    <form action="{{ route('proformas.destroy', $proforma) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('¿Eliminar esta proforma?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                                title="Eliminar">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center empty-state">
                                <i class="bi bi-inbox d-block mb-3"></i>
                                <div class="text-muted mb-2">No hay proformas registradas con esos filtros.</div>
                                <a href="{{ route('proformas.index') }}" class="btn btn-outline-primary rounded-pill px-4">
                                    Ver todas
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($proformas->hasPages())
        <div class="card-footer bg-white">
            {{ $proformas->links() }}
        </div>
    @endif
</div>
@endsection
