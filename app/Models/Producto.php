<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    

    protected $fillable = [
        'nombre',
        'marca_id',
        'proveedor_id',
        'precio',
        'existencia',
        'imagen'
    ];

    // 🔗 Marca
    public function marca()
    {

        return $this->belongsTo(Marca::class);
    }

    // 🔗 Proveedor
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    // 🔗 Movimientos del producto (entradas / salidas)
    public function movimientos()
    {
        return $this->hasMany(Movimiento::class, 'producto_id');
    }
}
