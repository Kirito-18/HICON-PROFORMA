<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proforma extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'cliente_nombre',
        'cliente_ruc',
        'cliente_direccion',
        'fecha',
        'fecha_vencimiento',
        'moneda',
        'subtotal',
        'igv',
        'total',
        'notas',
        'estado',
    ];

    protected $casts = [
        'fecha' => 'date',
        'fecha_vencimiento' => 'date',
        'subtotal' => 'decimal:2',
        'igv' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function items()
    {
        return $this->hasMany(ProformaItem::class)->orderBy('orden');
    }

    public static function generarNumero(): string
    {
        $ultimo = static::latest('id')->first();
        $correlativo = $ultimo ? $ultimo->id + 1 : 1;

        return 'PROF-' . str_pad($correlativo, 6, '0', STR_PAD_LEFT);
    }

    public function recalcularTotales(): void
    {
        $total = (float) $this->items()->sum('subtotal');
        $igv = round($total - ($total / 1.18), 2);
        $subtotal = round($total - $igv, 2);

        $this->update([
            'subtotal' => $subtotal,
            'igv' => $igv,
            'total' => $total,
        ]);
    }

    public function getEstadoBadgeAttribute(): string
    {
        return match ($this->estado) {
            'aprobado' => 'success',
            'rechazado' => 'danger',
            default => 'warning',
        };
    }
}