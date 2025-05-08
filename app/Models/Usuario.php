<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Usuario extends Model
{
    //
    use HasFactory;

    protected $table = 'usuarios';
    
    protected $fillable = [
        'nombre',
        'usuario',
        'email',
        'contraseña',
    ];

    protected $hidden = [
        'contraseña',
    ];

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }
}
