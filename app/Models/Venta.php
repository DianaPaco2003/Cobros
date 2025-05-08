<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Venta extends Model
{
    //
    use HasFactory;

    protected $table = 'ventas';
    
    protected $fillable = [
        'cliente_nombre',
        'usuario_id',
        'total',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

   // public function detalles()
   // {
     //   return $this->hasMany(DetalleVenta::class);
    //}
}
