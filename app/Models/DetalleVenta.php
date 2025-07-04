<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class DetalleVenta extends Model
{
        use HasFactory;

    public $timestamps = false;

    protected $table = 'detalle_ventas';
    
    protected $fillable = [
        'venta_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

//    public function getSubtotalAttribute()
 //   {
 //       return $this->precio_unitario * $this->cantidad;
 //   }
}