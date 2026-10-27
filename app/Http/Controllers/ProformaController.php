<?php

namespace App\Http\Controllers;

use App\Models\Proforma;
use App\Models\ProformaItem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ProformaController extends Controller
{
    public function index(Request $request)
    {
        $query = Proforma::query();

        if ($request->filled('buscar')) {
            $buscar = trim($request->buscar);

            $query->where(function ($q) use ($buscar) {
                $q->where('numero', 'like', "%{$buscar}%")
                    ->orWhere('cliente_nombre', 'like', "%{$buscar}%")
                    ->orWhere('cliente_ruc', 'like', "%{$buscar}%");
            });
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('fecha_desde')) {
            $query->whereDate('fecha', '>=', $request->fecha_desde);
        }

        if ($request->filled('fecha_hasta')) {
            $query->whereDate('fecha', '<=', $request->fecha_hasta);
        }

        $proformas = $query->latest()->paginate(15)->withQueryString();

        $totalProformas = Proforma::count();
        $pendientes = Proforma::where('estado', 'pendiente')->count();
        $aprobadas = Proforma::where('estado', 'aprobado')->count();
        $rechazadas = Proforma::where('estado', 'rechazado')->count();

        $ventasTotales = Proforma::where('estado', 'aprobado')->sum('total');
        $ventasMes = Proforma::where('estado', 'aprobado')
            ->whereMonth('fecha', now()->month)
            ->whereYear('fecha', now()->year)
            ->sum('total');

        $proformasHoy = Proforma::whereDate('fecha', today())->count();

        $conversion = $totalProformas > 0
            ? round(($aprobadas / $totalProformas) * 100, 2)
            : 0;

        $kpis = [
            'total' => $totalProformas,
            'pendientes' => $pendientes,
            'aprobadas' => $aprobadas,
            'rechazadas' => $rechazadas,
            'ventas_totales' => $ventasTotales,
            'ventas_mes' => $ventasMes,
            'proformas_hoy' => $proformasHoy,
            'conversion' => $conversion,
        ];

        return view('proformas.index', compact('proformas', 'kpis'));
    }

    public function create()
    {
        $numero = Proforma::generarNumero();

        return view('proformas.create', compact('numero'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero'                  => 'required|string|max:50|unique:proformas,numero',
            'fecha'                   => 'required|date',
            'fecha_vencimiento'       => 'nullable|date|after_or_equal:fecha',
            'cliente_nombre'          => 'nullable|string|max:255',
            'cliente_ruc'             => 'nullable|string|max:20',
            'cliente_direccion'       => 'nullable|string|max:255',
            'moneda'                  => 'nullable|in:PEN,USD',
            'notas'                   => 'nullable|string',
            'items'                   => 'required|array|min:1',
            'items.*.descripcion'     => 'nullable|string|max:255',
            'items.*.detalle'         => 'nullable|string',
            'items.*.precio_unitario' => 'nullable|numeric|min:0',
            'items.*.cantidad'        => 'nullable|numeric|min:0.01',
        ]);

        $items = collect($request->items)->filter(function ($item) {
            $descripcion = trim($item['descripcion'] ?? '');
            $detalle = trim($item['detalle'] ?? '');
            $precio = (float) ($item['precio_unitario'] ?? 0);
            $cantidad = (float) ($item['cantidad'] ?? 0);

            return $descripcion !== '' && ($detalle !== '' || $precio > 0 || $cantidad > 0);
        })->values();

        if ($items->isEmpty()) {
            return back()
                ->withErrors(['items' => 'Debes ingresar al menos un ítem válido.'])
                ->withInput();
        }

        $proforma = Proforma::create([
            'numero'            => $request->numero,
            'cliente_nombre'    => $request->cliente_nombre,
            'cliente_ruc'       => $request->cliente_ruc,
            'cliente_direccion' => $request->cliente_direccion,
            'fecha'             => $request->fecha,
            'fecha_vencimiento' => $request->fecha_vencimiento,
            'moneda'            => $request->moneda ?? 'PEN',
            'notas'             => $request->notas,
            'estado'            => 'pendiente',
            'subtotal'          => 0,
            'igv'               => 0,
            'total'             => 0,
        ]);

        foreach ($items as $orden => $itemData) {
            $cantidad = (float) ($itemData['cantidad'] ?? 1);
            $precio = (float) ($itemData['precio_unitario'] ?? 0);
            $subtotal = $cantidad * $precio;

            ProformaItem::create([
                'proforma_id'     => $proforma->id,
                'descripcion'     => trim($itemData['descripcion'] ?? ''),
                'detalle'         => trim($itemData['detalle'] ?? '') ?: null,
                'cantidad'        => $cantidad,
                'precio_unitario' => $precio,
                'subtotal'        => $subtotal,
                'orden'           => $orden,
            ]);
        }

        $proforma->recalcularTotales();

        return redirect()
            ->route('proformas.show', $proforma)
            ->with('success', 'Proforma creada exitosamente.');
    }

    public function show(Proforma $proforma)
    {
        $proforma->load('items');

        return view('proformas.show', compact('proforma'));
    }

    public function edit(Proforma $proforma)
    {
        $proforma->load('items');

        return view('proformas.edit', compact('proforma'));
    }

    public function update(Request $request, Proforma $proforma)
    {
        $request->validate([
            'fecha'                   => 'required|date',
            'fecha_vencimiento'       => 'nullable|date|after_or_equal:fecha',
            'cliente_nombre'          => 'nullable|string|max:255',
            'cliente_ruc'             => 'nullable|string|max:20',
            'cliente_direccion'       => 'nullable|string|max:255',
            'moneda'                  => 'nullable|in:PEN,USD',
            'estado'                  => 'nullable|in:pendiente,aprobado,rechazado',
            'notas'                   => 'nullable|string',
            'items'                   => 'required|array|min:1',
            'items.*.descripcion'     => 'nullable|string|max:255',
            'items.*.detalle'         => 'nullable|string',
            'items.*.precio_unitario' => 'nullable|numeric|min:0',
            'items.*.cantidad'        => 'nullable|numeric|min:0.01',
        ]);

        $items = collect($request->items)->filter(function ($item) {
            $descripcion = trim($item['descripcion'] ?? '');
            $detalle = trim($item['detalle'] ?? '');
            $precio = (float) ($item['precio_unitario'] ?? 0);
            $cantidad = (float) ($item['cantidad'] ?? 0);

            return $descripcion !== '' && ($detalle !== '' || $precio > 0 || $cantidad > 0);
        })->values();

        if ($items->isEmpty()) {
            return back()
                ->withErrors(['items' => 'Debes ingresar al menos un ítem válido.'])
                ->withInput();
        }

        $proforma->update([
            'cliente_nombre'    => $request->cliente_nombre,
            'cliente_ruc'       => $request->cliente_ruc,
            'cliente_direccion' => $request->cliente_direccion,
            'fecha'             => $request->fecha,
            'fecha_vencimiento' => $request->fecha_vencimiento,
            'moneda'            => $request->moneda ?? 'PEN',
            'notas'             => $request->notas,
            'estado'            => $request->estado ?? $proforma->estado,
        ]);

        $proforma->items()->delete();

        foreach ($items as $orden => $itemData) {
            $cantidad = (float) ($itemData['cantidad'] ?? 1);
            $precio = (float) ($itemData['precio_unitario'] ?? 0);
            $subtotal = $cantidad * $precio;

            ProformaItem::create([
                'proforma_id'     => $proforma->id,
                'descripcion'     => trim($itemData['descripcion'] ?? ''),
                'detalle'         => trim($itemData['detalle'] ?? '') ?: null,
                'cantidad'        => $cantidad,
                'precio_unitario' => $precio,
                'subtotal'        => $subtotal,
                'orden'           => $orden,
            ]);
        }

        $proforma->recalcularTotales();

        return redirect()
            ->route('proformas.show', $proforma)
            ->with('success', 'Proforma actualizada correctamente.');
    }

    public function destroy(Proforma $proforma)
    {
        $proforma->delete();

        return redirect()
            ->route('proformas.index')
            ->with('success', 'Proforma eliminada.');
    }

    public function cambiarEstado(Request $request, Proforma $proforma)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,aprobado,rechazado',
        ]);

        $proforma->update([
            'estado' => $request->estado,
        ]);

        return back()->with(
            'success',
            'Estado actualizado a ' . strtoupper($request->estado) . '.'
        );
    }

    public function pdf(Proforma $proforma)
    {
        $proforma->load('items');

        $pdf = Pdf::loadView('pdf.proforma', compact('proforma'))
            ->setPaper('a4');

        return $pdf->download('Proforma-' . $proforma->numero . '.pdf');
    }

    public function preview(Proforma $proforma)
    {
        $proforma->load('items');

        $pdf = Pdf::loadView('pdf.proforma', compact('proforma'))
            ->setPaper('a4');

        return $pdf->stream('Proforma-' . $proforma->numero . '.pdf');
    }
    public function dashboard()
    {
        $totalProformas = Proforma::count();
        $pendientes = Proforma::where('estado', 'pendiente')->count();
        $aprobadas = Proforma::where('estado', 'aprobado')->count();
        $rechazadas = Proforma::where('estado', 'rechazado')->count();

        $ventasTotales = Proforma::where('estado', 'aprobado')->sum('total');
        $ventasMes = Proforma::where('estado', 'aprobado')
            ->whereMonth('fecha', now()->month)
            ->whereYear('fecha', now()->year)
            ->sum('total');

        $proformasHoy = Proforma::whereDate('fecha', today())->count();

        $conversion = $totalProformas > 0
            ? round(($aprobadas / $totalProformas) * 100, 2)
            : 0;

        $ultimasProformas = Proforma::latest()->take(5)->get();

        $kpis = [
            'total' => $totalProformas,
            'pendientes' => $pendientes,
            'aprobadas' => $aprobadas,
            'rechazadas' => $rechazadas,
            'ventas_totales' => $ventasTotales,
            'ventas_mes' => $ventasMes,
            'proformas_hoy' => $proformasHoy,
            'conversion' => $conversion,
        ];
        $graficoEstados = [
            'pendientes' => $pendientes,
            'aprobadas' => $aprobadas,
            'rechazadas' => $rechazadas,
        ];

        $mesExpression = config('database.default') === 'sqlite'
            ? "cast(strftime('%m', fecha) as integer)"
            : 'MONTH(fecha)';

        $graficoMeses = Proforma::selectRaw("{$mesExpression} as mes, COUNT(*) as total")
            ->whereYear('fecha', now()->year)
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('total', 'mes')
            ->toArray();

        $mesesNombre = [
            1 => 'Ene',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Abr',
            5 => 'May',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Ago',
            9 => 'Sep',
            10 => 'Oct',
            11 => 'Nov',
            12 => 'Dic'
        ];

        $labelsMeses = [];
        $datosMeses = [];

        for ($i = 1; $i <= 12; $i++) {
            $labelsMeses[] = $mesesNombre[$i];
            $datosMeses[] = $graficoMeses[$i] ?? 0;
        }

        return view('dashboard', compact(
            'kpis',
            'ultimasProformas',
            'graficoEstados',
            'labelsMeses',
            'datosMeses'
        ));
    }
}
