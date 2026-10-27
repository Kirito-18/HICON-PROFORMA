@extends('layouts.app')

@section('title', 'Nueva Proforma – HICON IMPORT')

@section('content')
<div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
    <div>
        <h1 class="page-title mb-1">
            <i class="bi bi-file-earmark-plus me-2"></i>Nueva Proforma
        </h1>
        <p class="page-subtitle mb-0">
            Registra una nueva proforma con los datos del cliente, componentes y totales.
        </p>
    </div>

    <a href="{{ route('proformas.index') }}" class="btn btn-outline-secondary rounded-pill">
        <i class="bi bi-arrow-left me-1"></i> Volver
    </a>
</div>

@if ($errors->has('items'))
    <div class="alert alert-danger rounded-4 shadow-sm">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ $errors->first('items') }}
    </div>
@endif

<form action="{{ route('proformas.store') }}" method="POST" id="formProforma">
    @csrf

    <div class="row g-4">

        {{-- Datos de Cabecera --}}
        <div class="col-12">
            <div class="card card-hicon">
                <div class="card-header">
                    <i class="bi bi-info-circle me-2"></i>Datos de la Proforma
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">N° Proforma</label>
                            <input
                                type="text"
                                name="numero"
                                class="form-control @error('numero') is-invalid @enderror"
                                value="{{ old('numero', $numero) }}"
                                readonly
                            >
                            @error('numero')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Fecha <span class="text-danger">*</span></label>
                            <input
                                type="date"
                                name="fecha"
                                class="form-control @error('fecha') is-invalid @enderror"
                                value="{{ old('fecha', date('Y-m-d')) }}"
                                required
                            >
                            @error('fecha')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Vencimiento</label>
                            <input
                                type="date"
                                name="fecha_vencimiento"
                                class="form-control @error('fecha_vencimiento') is-invalid @enderror"
                                value="{{ old('fecha_vencimiento') }}"
                            >
                            @error('fecha_vencimiento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Moneda</label>
                            <select
                                name="moneda"
                                id="moneda"
                                class="form-select @error('moneda') is-invalid @enderror"
                                onchange="actualizarSimbolosMoneda()"
                            >
                                <option value="PEN" {{ old('moneda', 'PEN') == 'PEN' ? 'selected' : '' }}>
                                    S/. Soles (PEN)
                                </option>
                                <option value="USD" {{ old('moneda') == 'USD' ? 'selected' : '' }}>
                                    $ Dólares (USD)
                                </option>
                            </select>
                            @error('moneda')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Datos del Cliente --}}
        <div class="col-12">
            <div class="card card-hicon">
                <div class="card-header">
                    <i class="bi bi-person me-2"></i>Cliente
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-5">
                            <label class="form-label">Nombre / Razón Social</label>
                            <input
                                type="text"
                                name="cliente_nombre"
                                class="form-control @error('cliente_nombre') is-invalid @enderror"
                                value="{{ old('cliente_nombre') }}"
                                placeholder="Nombre del cliente"
                            >
                            @error('cliente_nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">RUC / DNI</label>
                            <input
                                type="text"
                                name="cliente_ruc"
                                class="form-control @error('cliente_ruc') is-invalid @enderror"
                                value="{{ old('cliente_ruc') }}"
                                placeholder="RUC o DNI"
                            >
                            @error('cliente_ruc')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Dirección</label>
                            <input
                                type="text"
                                name="cliente_direccion"
                                class="form-control @error('cliente_direccion') is-invalid @enderror"
                                value="{{ old('cliente_direccion') }}"
                                placeholder="Dirección"
                            >
                            @error('cliente_direccion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Componentes + Ítems extra --}}
        <div class="col-12">
            <div class="card card-hicon">
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <span>
                        <i class="bi bi-cpu me-2"></i>Componentes / Productos
                    </span>

                    <button
                        type="button"
                        class="btn btn-sm btn-light rounded-pill fw-semibold"
                        onclick="agregarItemExtra()"
                    >
                        <i class="bi bi-plus-lg me-1"></i> Agregar ítem
                    </button>
                </div>

                <div class="card-body">
                    <div class="row fw-semibold text-muted small mb-2 px-2 d-none d-md-flex">
                        <div class="col-md-2">Componente</div>
                        <div class="col-md-7">Descripción / Especificación</div>
                        <div class="col-md-3 text-end">Precio</div>
                    </div>

                    @php
                        $componentes = [
                            'PLACA MADRE',
                            'PROCESADOR',
                            'MEMORIA RAM',
                            'DISCO SSD',
                            'TARJETA DE VIDEO',
                            'CASE',
                            'MONITOR',
                            'TECLADO',
                            'MOUSE',
                            'OTROS',
                        ];
                    @endphp

                    @foreach($componentes as $i => $comp)
                        <div class="item-row row align-items-center g-2 mb-2" id="item-{{ $i }}">
                            <div class="col-md-2">
                                <span
                                    class="badge rounded-pill px-3 py-2 fw-semibold w-100 text-center"
                                    style="background:#e8f4fc; color:#0b60a8; font-size:.8rem; white-space:normal;"
                                >
                                    {{ $comp }}
                                </span>

                                <input type="hidden" name="items[{{ $i }}][descripcion]" value="{{ $comp }}">
                                <input type="hidden" name="items[{{ $i }}][cantidad]" value="1">
                            </div>

                            <div class="col-md-7">
                                <input
                                    type="text"
                                    name="items[{{ $i }}][detalle]"
                                    class="form-control"
                                    value="{{ old("items.$i.detalle") }}"
                                    placeholder="Marca, modelo, especificaciones..."
                                >
                            </div>

                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text fw-bold currency-symbol">S/</span>
                                    <input
                                        type="number"
                                        name="items[{{ $i }}][precio_unitario]"
                                        class="form-control text-end item-precio"
                                        value="{{ old("items.$i.precio_unitario") }}"
                                        placeholder="0.00"
                                        min="0"
                                        step="0.01"
                                        oninput="calcularFila(this)"
                                    >
                                </div>
                                <span class="item-subtotal d-none" id="subtotal-{{ $i }}">0.00</span>
                            </div>
                        </div>
                    @endforeach

                    <div id="extras-container"></div>

                    <hr class="mt-3">

                    <div class="row justify-content-end mt-3">
                        <div class="col-md-4">
                            <table class="table table-sm mb-0">
                                <tr>
                                    <td class="text-muted">Valor Venta (sin IGV)</td>
                                    <td class="text-end fw-semibold">
                                        <span class="currency-symbol-text">S/</span>
                                        <span id="display-subtotal">0.00</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">IGV incluido (18%)</td>
                                    <td class="text-end fw-semibold">
                                        <span class="currency-symbol-text">S/</span>
                                        <span id="display-igv">0.00</span>
                                    </td>
                                </tr>
                                <tr class="table-primary">
                                    <td class="fw-bold fs-5">TOTAL</td>
                                    <td class="text-end fw-bold fs-5">
                                        <span class="currency-symbol-text">S/</span>
                                        <span id="display-total">0.00</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Observaciones --}}
        <div class="col-12">
            <div class="card card-hicon">
                <div class="card-header">
                    <i class="bi bi-chat-left-text me-2"></i>Observaciones
                </div>
                <div class="card-body">
                    <textarea
                        name="notas"
                        class="form-control @error('notas') is-invalid @enderror"
                        rows="3"
                        placeholder="Condiciones comerciales, tiempo de entrega, garantía..."
                    >{{ old('notas') }}</textarea>
                    @error('notas')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-12 d-flex gap-2 justify-content-end">
            <a href="{{ route('proformas.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                Cancelar
            </a>

            <button type="submit" class="btn btn-hicon px-5">
                <i class="bi bi-save me-2"></i>Guardar Proforma
            </button>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
    let extraCount = document.querySelectorAll('.item-row').length;

    function obtenerSimboloMoneda() {
        const moneda = document.getElementById('moneda')?.value || 'PEN';
        return moneda === 'USD' ? '$' : 'S/';
    }

    function actualizarSimbolosMoneda() {
        const simbolo = obtenerSimboloMoneda();

        document.querySelectorAll('.currency-symbol').forEach(el => {
            el.textContent = simbolo;
        });

        document.querySelectorAll('.currency-symbol-text').forEach(el => {
            el.textContent = simbolo;
        });
    }

    function agregarItemExtra() {
        const index = extraCount++;

        const html = `
            <div class="item-row row align-items-center g-2 mb-2" id="item-${index}">
                <div class="col-md-2">
                    <span
                        class="badge rounded-pill px-3 py-2 fw-semibold w-100 text-center"
                        style="background:#fff3cd; color:#856404; font-size:.8rem; white-space:normal;"
                    >
                        OTROS
                    </span>
                    <input type="hidden" name="items[${index}][descripcion]" value="OTROS">
                    <input type="hidden" name="items[${index}][cantidad]" value="1">
                </div>

                <div class="col-md-7">
                    <input
                        type="text"
                        name="items[${index}][detalle]"
                        class="form-control"
                        placeholder="Describe el producto o servicio..."
                    >
                </div>

                <div class="col-md-2">
                    <div class="input-group">
                        <span class="input-group-text fw-bold currency-symbol">${obtenerSimboloMoneda()}</span>
                        <input
                            type="number"
                            name="items[${index}][precio_unitario]"
                            class="form-control text-end item-precio"
                            value=""
                            min="0"
                            step="0.01"
                            placeholder="0.00"
                            oninput="calcularFila(this)"
                        >
                    </div>
                    <span class="item-subtotal d-none" id="subtotal-${index}">0.00</span>
                </div>

                <div class="col-md-1 text-end">
                    <button
                        type="button"
                        class="btn btn-sm btn-outline-danger rounded-pill"
                        onclick="eliminarExtra(${index})"
                        title="Eliminar"
                    >
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        `;

        document.getElementById('extras-container').insertAdjacentHTML('beforeend', html);
        document.querySelector(`#item-${index} input[name*='[detalle]']`)?.focus();
        actualizarTotales();
    }

    function eliminarExtra(index) {
        document.getElementById(`item-${index}`)?.remove();
        actualizarTotales();
    }

    function calcularFila(el) {
        const row = el.closest('.item-row');
        if (!row) return;

        const index = row.id.replace('item-', '');
        const precio = parseFloat(el.value) || 0;
        const span = document.getElementById(`subtotal-${index}`);

        if (span) {
            span.textContent = precio.toFixed(2);
        }

        actualizarTotales();
    }

    function actualizarTotales() {
        let total = 0;

        document.querySelectorAll('.item-subtotal').forEach(el => {
            total += parseFloat(el.textContent) || 0;
        });

        const igv = total - (total / 1.18);
        const subtotal = total - igv;

        document.getElementById('display-subtotal').textContent = subtotal.toFixed(2);
        document.getElementById('display-igv').textContent = igv.toFixed(2);
        document.getElementById('display-total').textContent = total.toFixed(2);
    }

    document.addEventListener('DOMContentLoaded', function () {
        actualizarSimbolosMoneda();

        document.querySelectorAll('.item-precio').forEach(input => {
            calcularFila(input);
        });

        actualizarTotales();
    });
</script>
@endpush