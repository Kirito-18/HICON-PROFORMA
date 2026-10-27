<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: DejaVu Sans, Arial, sans-serif;
    font-size: 10px;
    color: #1a2b4a;
    background: #f0f6ff;
    line-height: 1.7;
    word-spacing: 1.5px;
}

.watermark-wrap {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    text-align: center;
    z-index: 0;
}

.watermark-wrap img {
    margin-top: 210px;
    width: 330px;
    height: 330px;
    object-fit: contain;
    opacity: 0.05;
}

.header {
    background: #fff;
    border-radius: 0 0 28px 28px;
    margin: 0 10px;
    padding: 14px 20px 12px;
    border-bottom: 4px solid #1db6e8;
}

.header-table {
    width: 100%;
}

.logo-cell {
    width: 90px;
    vertical-align: middle;
}

.logo-bubble {
    width: 90px;
    height: 90px;
    border: none;
    overflow: visible;
    background: transparent;
    text-align: center;
}

.logo-bubble img {
    width: 90px;
    height: 90px;
    object-fit: contain;
    display: block;
}

.logo-text-fallback {
    width: 72px;
    height: 72px;
    display: table;
}

.logo-text-inner {
    display: table-cell;
    vertical-align: middle;
    text-align: center;
    color: #0b60a8;
    font-weight: 900;
    font-size: 9px;
    line-height: 1.3;
}

.title-cell {
    text-align: center;
    vertical-align: middle;
    padding: 0 10px;
}

.titulo {
    font-size: 40px;
    font-weight: 900;
    letter-spacing: 10px;
    color: #0b60a8;
    line-height: 1;
}

.subtitulo-addr {
    margin-top: 6px;
    font-size: 9px;
    font-weight: 700;
    color: #2a4a7a;
    letter-spacing: 1.5px;
    line-height: 1.9;
}

.balance-cell {
    width: 90px;
}

.meta-row {
    display: table;
    width: 100%;
    padding: 9px 20px 4px;
}

.meta-left {
    display: table-cell;
    vertical-align: middle;
}

.meta-right {
    display: table-cell;
    text-align: right;
    vertical-align: middle;
}

.badge {
    display: inline-block;
    border-radius: 30px;
    padding: 5px 16px;
    font-size: 9.5px;
    font-weight: 700;
    letter-spacing: .5px;
    margin-left: 4px;
}

.badge-blue {
    background: #0b60a8;
    color: #fff;
}

.badge-amber {
    background: #0b60a8;
    color: #fff;
}

.badge-cyan {
    background: #1db6e8;
    color: #fff;
}

.cliente-bubble {
    margin: 7px 20px;
    background: #fff;
    border-radius: 16px;
    border-left: 5px solid #1db6e8;
    padding: 7px 14px;
    font-size: 9.5px;
    line-height: 2;
}

.cliente-bubble strong {
    color: #0b60a8;
    font-size: 8.5px;
}

.tabla-wrap {
    padding: 5px 20px 4px;
}

.items-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 6px;
}

.items-table thead tr th {
    background: #0b60a8;
    color: #fff;
    padding: 8px 10px;
    font-size: 9.5px;
    letter-spacing: .5px;
}

.items-table thead tr th:first-child {
    border-radius: 14px 0 0 14px;
}

.items-table thead tr th:last-child {
    border-radius: 0 14px 14px 0;
}

.items-table thead th.tc {
    text-align: center;
}

.items-table thead th.tr {
    text-align: right;
}

.items-table tbody td {
    background: #fff;
    padding: 8px 10px;
    font-size: 9.5px;
    vertical-align: middle;
    border-top: 1px solid #ddeef8;
    border-bottom: 1px solid #ddeef8;
}

.items-table tbody td:first-child {
    border-radius: 15px 0 0 15px;
    border-left: 1px solid #ddeef8;
    color: #8ca5c5;
    font-weight: 700;
    text-align: center;
}

.items-table tbody td:last-child {
    border-radius: 0 15px 15px 0;
    border-right: 1px solid #ddeef8;
}

.items-table tbody tr:nth-child(even) td {
    background: #f0f8ff;
}

.items-table td.tc {
    text-align: center;
}

.items-table td.tr {
    text-align: right;
}

.desc-bubble {
    background: #ddeeff;
    border-radius: 12px;
    padding: 6px 11px;
}

.comp-nombre {
    font-weight: 700;
    color: #0b60a8;
}

.comp-detalle {
    color: #3d5578;
}

.comp-vacio {
    color: #b0bfd4;
    font-style: italic;
    font-size: 8.5px;
}

.precio-pill {
    background: #1db6e8;
    color: #fff;
    border-radius: 30px;
    padding: 4px 10px;
    font-weight: 700;
    font-size: 9.5px;
    text-align: center;
    display: block;
}

.precio-dash {
    color: #c0d4e8;
}

.totales-wrap {
    text-align: right;
    padding: 3px 20px 5px;
}

.totales-card {
    display: inline-block;
    background: #fff;
    border-radius: 18px;
    padding: 9px 18px;
    min-width: 240px;
    border: 1px solid #cde6f8;
}

.totales-card table {
    width: 100%;
}

.fila-sub td {
    padding: 3px 6px;
    font-size: 9.5px;
    color: #5a7a9a;
    border-bottom: 1px dashed #ddeef8;
}

.fila-igv td {
    padding: 3px 6px 6px;
    font-size: 9.5px;
    color: #5a7a9a;
}

.fila-total-td {
    padding: 0;
}

.total-pill {
    background: #0b60a8;
    color: #fff;
    border-radius: 14px;
    padding: 0;
    width: 100%;
    border-collapse: collapse;
}

.total-pill td {
    padding: 8px 12px;
    font-weight: 900;
    font-size: 14px;
    background: none;
    border: none;
}

.total-pill td:last-child {
    text-align: right;
}

.notas-bubble {
    margin: 5px 20px;
    background: #fffbe6;
    border-radius: 14px;
    border-left: 4px solid #ffc107;
    padding: 6px 13px;
    font-size: 8.5px;
    color: #6b5a2a;
    line-height: 1.7;
}

.footer {
    background: #0b60a8;
    margin: 12px 10px 0;
    border-radius: 20px 20px 0 0;
    padding: 9px 20px;
    text-align: center;
    color: #fff;
    font-size: 9px;
    letter-spacing: .5px;
}
</style>
</head>
<body>

@php
    $exts = ['png', 'jpg', 'jpeg', 'webp'];
    $logoSrc = null;
    $simbolo = $proforma->moneda === 'USD' ? '$' : 'S/';

    foreach ($exts as $ext) {
        $path = public_path("images/logoweb.$ext");
        if (file_exists($path)) {
            $mime = ($ext === 'jpg' || $ext === 'jpeg') ? 'jpeg' : $ext;
            $logoSrc = "data:image/$mime;base64," . base64_encode(file_get_contents($path));
            break;
        }
    }
@endphp

@if($logoSrc)
<div class="watermark-wrap">
    <img src="{{ $logoSrc }}" alt="">
</div>
@endif

<div class="header">
    <table class="header-table">
        <tr>
            <td class="logo-cell">
                <div class="logo-bubble">
                    @if($logoSrc)
                        <img src="{{ $logoSrc }}" alt="Logo">
                    @else
                        <div class="logo-text-fallback">
                            <div class="logo-text-inner">HICON<br>IMPORT</div>
                        </div>
                    @endif
                </div>
            </td>

            <td class="title-cell">
                <div class="titulo">PROFORMA</div>
                <div class="subtitulo-addr">
                    JR. GONZALES PRADA 481<br>
                    JULIACA – SAN ROMÁN – PUNO<br>
                    999 999 595
                </div>
            </td>

            <td class="balance-cell"></td>
        </tr>
    </table>
</div>

<div class="meta-row">
    <div class="meta-left">
        <span class="badge badge-blue">{{ $proforma->numero }}</span>
    </div>
    <div class="meta-right">
        <span class="badge badge-amber">Fecha: {{ $proforma->fecha?->format('d/m/Y') ?? '—' }}</span>
    </div>
</div>

@if($proforma->cliente_nombre || $proforma->cliente_ruc || $proforma->cliente_direccion)
<div class="cliente-bubble">
    @if($proforma->cliente_nombre)
        <strong>CLIENTE:</strong>&nbsp;{{ $proforma->cliente_nombre }}
        @if($proforma->cliente_ruc || $proforma->cliente_direccion)
            &nbsp;&nbsp;
        @endif
    @endif

    @if($proforma->cliente_ruc)
        <strong>DNI/RUC:</strong>&nbsp;{{ $proforma->cliente_ruc }}
        @if($proforma->cliente_direccion)
            &nbsp;&nbsp;
        @endif
    @endif

    @if($proforma->cliente_direccion)
        <strong>DIRECCIÓN:</strong>&nbsp;{{ $proforma->cliente_direccion }}
    @endif
</div>
@endif

<div class="tabla-wrap">
    <table class="items-table">
        <thead>
            <tr>
                <th style="width:4%">#</th>
                <th style="width:55%; text-align:left;">Descripción</th>
                <th class="tc" style="width:8%">Cant</th>
                <th class="tr" style="width:15%">P. Unit.</th>
                <th class="tr" style="width:18%">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proforma->items as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>

                    <td>
                        <div class="desc-bubble">
                            <span class="comp-nombre">{{ $item->descripcion }}:</span>
                            @if($item->detalle)
                                &nbsp;<span class="comp-detalle">{{ $item->detalle }}</span>
                            @else
                                &nbsp;<span class="comp-vacio">sin especificación</span>
                            @endif
                        </div>
                    </td>

                    <td class="tc">{{ (int) $item->cantidad }}</td>

                    <td class="tr">
                        @if((float) $item->precio_unitario > 0)
                            {{ $simbolo }} {{ number_format($item->precio_unitario, 2) }}
                        @else
                            <span class="precio-dash">—</span>
                        @endif
                    </td>

                    <td class="tr">
                        @if((float) $item->subtotal > 0)
                            <div class="precio-pill">{{ $simbolo }} {{ number_format($item->subtotal, 2) }}</div>
                        @else
                            <span class="precio-dash">—</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="totales-wrap">
    <div class="totales-card">
        <table>
            <tr class="fila-sub">
                <td style="text-align:left;">Subtotal (sin IGV)</td>
                <td style="text-align:right; font-weight:600;">
                    {{ $simbolo }} {{ number_format($proforma->subtotal, 2) }}
                </td>
            </tr>
            <tr class="fila-igv">
                <td style="text-align:left;">IGV incluido (18%)</td>
                <td style="text-align:right; font-weight:600;">
                    {{ $simbolo }} {{ number_format($proforma->igv, 2) }}
                </td>
            </tr>
            <tr>
                <td colspan="2" class="fila-total-td">
                    <table class="total-pill">
                        <tr>
                            <td>TOTAL</td>
                            <td>{{ $simbolo }} {{ number_format($proforma->total, 2) }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</div>

@if($proforma->notas)
<div class="notas-bubble">
    <strong>Observaciones:</strong> {!! nl2br(e($proforma->notas)) !!}
</div>
@endif

<div class="footer">
    <strong>HICON GROUP</strong> &nbsp;|&nbsp; hiconimport.com &nbsp;|&nbsp; &#9742; 999 999 595
</div>

</body>
</html>
