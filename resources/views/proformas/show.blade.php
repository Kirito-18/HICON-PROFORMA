@extends('layouts.app')

@section('title', 'Proforma ' . $proforma->numero . ' – HICON IMPORT')

@section('content')
@php
$simbolo = $proforma->moneda === 'USD' ? '$' : 'S/';
@endphp

<div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
    <div>
        <h1 class="page-title mb-1">
            <i class="bi bi-file-earmark-text me-2"></i>{{ $proforma->numero }}
        </h1>
        <p class="page-subtitle mb-0">
            Revisa el detalle completo de la proforma generada.
        </p>
    </div>

    <div class="d-flex gap-2 flex-wrap">
        <a href="{{ route('proformas.edit', $proforma) }}" class="btn btn-warning rounded-pill">
            <i class="bi bi-pencil me-1"></i> Editar
        </a>

        <a href="{{ route('proformas.preview', $proforma) }}" class="btn btn-outline-danger rounded-pill" target="_blank">
            <i class="bi bi-eye me-1"></i> Vista PDF
        </a>

        <a href="{{ route('proformas.pdf', $proforma) }}" class="btn btn-hicon rounded-pill">
            <i class="bi bi-download me-1"></i> Descargar PDF
        </a>
        <button type="button" class="btn btn-success rounded-pill" onclick="enviarPorWhatsapp()">
            <i class="bi bi-whatsapp me-1"></i> Enviar por WhatsApp
        </button>
        <a href="{{ route('proformas.index', $proforma) }}" class="btn btn-outline-secondary rounded-pill">
            <i class="bi bi-arrow-left me-1"></i> Volver
        </a>
    </div>
</div>
@push('scripts')
<script>
    function enviarPorWhatsapp() {
        //Aqui se cambia el mensaje que sera cipiado y evniado por whatsapp
const mensaje = `Hola, le saluda HICON GROUP. Le compartimos su proforma {{ $proforma->numero }} en formato PDF. Gracias por su preferencia.`;
        navigator.clipboard.writeText(mensaje).then(() => {
            window.open("{{ route('proformas.preview', $proforma) }}", "_blank");
            window.open("https://web.whatsapp.com/", "_blank");

            alert('Se copió el mensaje, se abrió WhatsApp Web y también la vista previa del PDF.');
        }).catch(() => {
            window.open("{{ route('proformas.preview', $proforma) }}", "_blank");
            window.open("https://web.whatsapp.com/", "_blank");

            alert('Se abrió WhatsApp Web y el PDF, pero no se pudo copiar el mensaje automáticamente. Cópialo manualmente.');
        });
    }
</script>
@endpush
<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card card-hicon h-100">
            <div class="card-header">
                <i class="bi bi-building me-2"></i>Empresa
            </div>
            <div class="card-body">
                <p class="fw-bold fs-5 mb-1">HICON GROUP</p>
                <p class="text-muted mb-1">Jr. Gonzales Prada 481, Juliaca – San Román – Puno</p>
                <p class="text-muted mb-0">
                    <i class="bi bi-whatsapp text-success me-1"></i>999 999 595
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-hicon h-100">
            <div class="card-header">
                <i class="bi bi-person me-2"></i>Cliente
            </div>
            <div class="card-body">
                <p class="fw-bold fs-5 mb-1">{{ $proforma->cliente_nombre ?: 'Sin nombre' }}</p>

                @if ($proforma->cliente_ruc)
                <p class="text-muted mb-1">RUC/DNI: {{ $proforma->cliente_ruc }}</p>
                @endif

                @if ($proforma->cliente_direccion)
                <p class="text-muted mb-0">{{ $proforma->cliente_direccion }}</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="card card-hicon mb-4">
    <div class="card-body">
        <div class="row text-center g-3">
            <div class="col-6 col-md-3">
                <div class="text-muted small">Número</div>
                <div class="fw-bold text-primary">{{ $proforma->numero }}</div>
            </div>

            <div class="col-6 col-md-3">
                <div class="text-muted small">Fecha</div>
                <div class="fw-bold">{{ $proforma->fecha?->format('d/m/Y') ?? '—' }}</div>
            </div>

            <div class="col-6 col-md-3">
                <div class="text-muted small">Vencimiento</div>
                <div class="fw-bold">{{ $proforma->fecha_vencimiento?->format('d/m/Y') ?? '—' }}</div>
            </div>

            <div class="col-6 col-md-3">
                <div class="text-muted small">Estado</div>
                <span class="badge badge-{{ $proforma->estado }} px-3 py-2 rounded-pill">
                    {{ strtoupper($proforma->estado) }}
                </span>
            </div>
        </div>
    </div>
</div>

<div class="card card-hicon mb-4">
    <div class="card-header">
        <i class="bi bi-cart3 me-2"></i>Detalle de Productos / Servicios
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-proforma table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Descripción</th>
                        <th class="text-center">Cant.</th>
                        <th class="text-end">P. Unit.</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($proforma->items as $i => $item)
                    <tr>
                        <td class="text-muted">{{ $i + 1 }}</td>

                        <td>
                            <div class="fw-semibold">{{ $item->descripcion }}</div>
                            @if ($item->detalle)
                            <div class="text-muted small">{{ $item->detalle }}</div>
                            @endif
                        </td>

                        <td class="text-center">{{ number_format($item->cantidad, 2) }}</td>
                        <td class="text-end">{{ $simbolo }} {{ number_format($item->precio_unitario, 2) }}</td>
                        <td class="text-end fw-bold">{{ $simbolo }} {{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            No hay ítems registrados en esta proforma.
                        </td>
                    </tr>
                    @endforelse
                </tbody>

                <tfoot>
                    <tr class="table-light">
                        <td colspan="4" class="text-end text-muted">Subtotal (sin IGV)</td>
                        <td class="text-end fw-semibold">{{ $simbolo }} {{ number_format($proforma->subtotal, 2) }}</td>
                    </tr>
                    <tr class="table-light">
                        <td colspan="4" class="text-end text-muted">IGV incluido (18%)</td>
                        <td class="text-end fw-semibold">{{ $simbolo }} {{ number_format($proforma->igv, 2) }}</td>
                    </tr>
                    <tr class="table-primary fw-bold fs-5">
                        <td colspan="4" class="text-end">TOTAL</td>
                        <td class="text-end">{{ $simbolo }} {{ number_format($proforma->total, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

@if ($proforma->notas)
<div class="card card-hicon">
    <div class="card-header">
        <i class="bi bi-chat-left-text me-2"></i>Observaciones
    </div>
    <div class="card-body">
        {!! nl2br(e($proforma->notas)) !!}
    </div>
</div>
@endif
@endsection
