<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movimiento extends Model
{
     protected $fillable = [
        'usuario_id',
        'producto_id',
        'proveedor_id',
        'tipo',
        'cantidad',
        'costo',
        'fecha',
    ];
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class);
    }
    
    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }
    
    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class);
    }
}
