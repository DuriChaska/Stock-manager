<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proveedor extends Model
{
    protected $table = 'proveedores';

    protected $fillable = [
        'nombre_empresa',
        'nombre_contacto',
        'email',
        'telefono',
        'direccion',
        'descripcion',
        'activo'
    ];


    
    public function movimientos(): HasMany
    {
        return $this->hasMany(Movimiento::class);
    }
}
