<div class="item-row row align-items-center g-2" id="item-{{ $index }}">
    <div class="col-12 col-md-5">
        <input type="text"
               name="items[{{ $index }}][descripcion]"
               class="form-control"
               placeholder="Descripción del producto o servicio"
               value="{{ old("items.$index.descripcion", $item->descripcion ?? '') }}"
               required>
        <input type="text"
               name="items[{{ $index }}][detalle]"
               class="form-control form-control-sm mt-1"
               placeholder="Detalle adicional (opcional)"
               value="{{ old("items.$index.detalle", $item->detalle ?? '') }}">
    </div>
    <div class="col-6 col-md-2">
        <input type="number"
               name="items[{{ $index }}][cantidad]"
               class="form-control text-center item-cantidad"
               value="{{ old("items.$index.cantidad", $item->cantidad ?? 1) }}"
               min="0.01" step="0.01" required
               oninput="calcularFila({{ $index }})">
    </div>
    <div class="col-6 col-md-2">
        <div class="input-group input-group-sm">
            <span class="input-group-text">S/</span>
            <input type="number"
                   name="items[{{ $index }}][precio_unitario]"
                   class="form-control text-end item-precio"
                   value="{{ old("items.$index.precio_unitario", $item->precio_unitario ?? '0.00') }}"
                   min="0" step="0.01" required
                   oninput="calcularFila({{ $index }})">
        </div>
    </div>
    <div class="col-6 col-md-2 text-end">
        <span class="fw-bold item-subtotal" id="subtotal-{{ $index }}">
            {{ number_format($item->subtotal ?? 0, 2) }}
        </span>
    </div>
    <div class="col-6 col-md-1 text-end">
        <button type="button" class="btn btn-sm btn-outline-danger"
                onclick="eliminarItem({ $index })">
            <i class="bi bi-trash"></i>
        </button>
    </div>
</div>
