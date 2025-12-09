<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Producto;
use App\Models\Proveedor;

class Movimiento extends Model
{
    use HasFactory;

        protected $fillable = [
        'usuario_id',
        'producto_id',
        'proveedor_id',
        'tipo',
        'cantidad',
        'costo',
        'fecha',
    ];


    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
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
