<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Usuario;
   class Venta extends Model
{
     use HasFactory;

    public $timestamps = false;

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

    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class);
    }
}

