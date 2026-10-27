@extends('layouts.app')

@section('title', 'Editar ' . $proforma->numero . ' – HICON IMPORT')

@section('content')
<div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
    <div>
        <h1 class="page-title mb-1">
            <i class="bi bi-pencil-square me-2"></i>Editar {{ $proforma->numero }}
        </h1>
        <p class="page-subtitle mb-0">
            Modifica los datos de la proforma, sus ítems y el estado actual.
        </p>
    </div>

    <a href="{{ route('proformas.show', $proforma) }}" class="btn btn-outline-secondary rounded-pill">
        <i class="bi bi-arrow-left me-1"></i> Volver
    </a>
</div>

@if ($errors->has('items'))
    <div class="alert alert-danger rounded-4 shadow-sm">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ $errors->first('items') }}
    </div>
@endif

<form 
    action="{{ route('proformas.update', $proforma) }}" 
    method="POST" 
    id="formProforma"
    data-item-count="{{ $proforma->items->count() }}"
>
    @csrf
    @method('PUT')

    <div class="row g-4">

        {{-- Cabecera --}}
        <div class="col-12">
            <div class="card card-hicon">
                <div class="card-header">
                    <i class="bi bi-info-circle me-2"></i>Datos de la Proforma
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">N° Proforma</label>
                            <input type="text" class="form-control" value="{{ $proforma->numero }}" readonly>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Fecha <span class="text-danger">*</span></label>
                            <input
                                type="date"
                                name="fecha"
                                class="form-control @error('fecha') is-invalid @enderror"
                                value="{{ old('fecha', $proforma->fecha?->format('Y-m-d')) }}"
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
                                value="{{ old('fecha_vencimiento', $proforma->fecha_vencimiento?->format('Y-m-d')) }}"
                            >
                            @error('fecha_vencimiento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-2">
                            <label class="form-label">Moneda</label>
                            <select
                                name="moneda"
                                id="moneda"
                                class="form-select @error('moneda') is-invalid @enderror"
                                onchange="actualizarSimbolosMoneda()"
                            >
                                <option value="PEN" {{ old('moneda', $proforma->moneda) == 'PEN' ? 'selected' : '' }}>
                                    S/. Soles
                                </option>
                                <option value="USD" {{ old('moneda', $proforma->moneda) == 'USD' ? 'selected' : '' }}>
                                    $ Dólares
                                </option>
                            </select>
                            @error('moneda')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-1">
                            <label class="form-label">Estado</label>
                            <select
                                name="estado"
                                class="form-select @error('estado') is-invalid @enderror"
                            >
                                <option value="pendiente" {{ old('estado', $proforma->estado) == 'pendiente' ? 'selected' : '' }}>
                                    Pendiente
                                </option>
                                <option value="aprobado" {{ old('estado', $proforma->estado) == 'aprobado' ? 'selected' : '' }}>
                                    Aprobado
                                </option>
                                <option value="rechazado" {{ old('estado', $proforma->estado) == 'rechazado' ? 'selected' : '' }}>
                                    Rechazado
                                </option>
                            </select>
                            @error('estado')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Cliente --}}
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
                                value="{{ old('cliente_nombre', $proforma->cliente_nombre) }}"
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
                                value="{{ old('cliente_ruc', $proforma->cliente_ruc) }}"
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
                                value="{{ old('cliente_direccion', $proforma->cliente_direccion) }}"
                            >
                            @error('cliente_direccion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Ítems --}}
        <div class="col-12">
            <div class="card card-hicon">
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <span>
                        <i class="bi bi-cart3 me-2"></i>Productos / Servicios
                    </span>

                    <button
                        type="button"
                        class="btn btn-sm btn-light rounded-pill fw-semibold"
                        onclick="agregarItem()"
                    >
                        <i class="bi bi-plus-lg me-1"></i> Agregar ítem
                    </button>
                </div>

                <div class="card-body">
                    <div class="row fw-semibold text-muted small mb-2 px-2 d-none d-md-flex">
                        <div class="col-md-5">Descripción</div>
                        <div class="col-md-2 text-center">Cant.</div>
                        <div class="col-md-2 text-end">P. Unit.</div>
                        <div class="col-md-2 text-end">Subtotal</div>
                        <div class="col-md-1"></div>
                    </div>

                    <div id="items-container">
                        @foreach($proforma->items as $i => $item)
                            @include('proformas._item_row', ['index' => $i, 'item' => $item])
                        @endforeach
                    </div>

                    <div class="row justify-content-end mt-4">
                        <div class="col-md-4">
                            <table class="table table-sm mb-0">
                                <tr>
                                    <td class="text-muted">Subtotal (sin IGV)</td>
                                    <td class="text-end fw-semibold">
                                        <span class="currency-symbol-text">{{ $proforma->moneda === 'USD' ? '$' : 'S/' }}</span>
                                        <span id="display-subtotal">{{ number_format($proforma->subtotal, 2) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">IGV incluido (18%)</td>
                                    <td class="text-end fw-semibold">
                                        <span class="currency-symbol-text">{{ $proforma->moneda === 'USD' ? '$' : 'S/' }}</span>
                                        <span id="display-igv">{{ number_format($proforma->igv, 2) }}</span>
                                    </td>
                                </tr>
                                <tr class="table-primary">
                                    <td class="fw-bold fs-5">TOTAL</td>
                                    <td class="text-end fw-bold fs-5">
                                        <span class="currency-symbol-text">{{ $proforma->moneda === 'USD' ? '$' : 'S/' }}</span>
                                        <span id="display-total">{{ number_format($proforma->total, 2) }}</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Notas --}}
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
                    >{{ old('notas', $proforma->notas) }}</textarea>
                    @error('notas')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-12 d-flex gap-2 justify-content-end">
            <a href="{{ route('proformas.show', $proforma) }}" class="btn btn-outline-secondary rounded-pill px-4">
                Cancelar
            </a>

            <button type="submit" class="btn btn-hicon px-5">
                <i class="bi bi-save me-2"></i>Actualizar Proforma
            </button>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
let itemCount = parseInt(document.getElementById('formProforma').dataset.itemCount, 10) || 0;

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

    function agregarItem() {
        const index = itemCount++;

        const html = `
            <div class="item-row row align-items-center g-2" id="item-${index}">
                <div class="col-12 col-md-5">
                    <input
                        type="text"
                        name="items[${index}][descripcion]"
                        class="form-control"
                        placeholder="Descripción"
                        required
                    >
                    <input
                        type="text"
                        name="items[${index}][detalle]"
                        class="form-control form-control-sm mt-1"
                        placeholder="Detalle (opcional)"
                    >
                </div>

                <div class="col-6 col-md-2">
                    <input
                        type="number"
                        name="items[${index}][cantidad]"
                        class="form-control text-center item-cantidad"
                        value="1"
                        min="0.01"
                        step="0.01"
                        required
                        oninput="calcularFila(${index})"
                    >
                </div>

                <div class="col-6 col-md-2">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text currency-symbol">${obtenerSimboloMoneda()}</span>
                        <input
                            type="number"
                            name="items[${index}][precio_unitario]"
                            class="form-control text-end item-precio"
                            value="0.00"
                            min="0"
                            step="0.01"
                            required
                            oninput="calcularFila(${index})"
                        >
                    </div>
                </div>

                <div class="col-6 col-md-2 text-end">
                    <span class="fw-bold item-subtotal" id="subtotal-${index}">0.00</span>
                </div>

                <div class="col-6 col-md-1 text-end">
                    <button
                        type="button"
                        class="btn btn-sm btn-outline-danger"
                        onclick="eliminarItem(${index})"
                        title="Eliminar"
                    >
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        `;

        document.getElementById('items-container').insertAdjacentHTML('beforeend', html);
        document.querySelector(`#item-${index} input[name*='[descripcion]']`)?.focus();
        actualizarTotales();
    }

    function calcularFila(index) {
        const fila = document.getElementById(`item-${index}`);
        if (!fila) return;

        const cantidad = parseFloat(fila.querySelector('.item-cantidad')?.value) || 0;
        const precio = parseFloat(fila.querySelector('.item-precio')?.value) || 0;
        const subtotal = cantidad * precio;

        const subtotalEl = fila.querySelector('.item-subtotal');
        if (subtotalEl) {
            subtotalEl.textContent = subtotal.toFixed(2);
        }

        actualizarTotales();
    }

    function eliminarItem(index) {
        if (document.querySelectorAll('.item-row').length <= 1) {
            alert('Debe haber al menos un ítem.');
            return;
        }

        document.getElementById(`item-${index}`)?.remove();
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

        document.querySelectorAll('.item-row').forEach(fila => {
            const id = parseInt(fila.id.replace('item-', ''), 10);
            calcularFila(id);

            fila.querySelector('.item-cantidad')?.addEventListener('input', () => calcularFila(id));
            fila.querySelector('.item-precio')?.addEventListener('input', () => calcularFila(id));
        });

        actualizarTotales();
    });
</script>
@endpush