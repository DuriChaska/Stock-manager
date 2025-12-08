<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Producto extends Model
{
    use HasFactory;
    
    protected $table = 'productos'; 

    protected $fillable = [
        'nombre',
        'marca_id',
        'talla',
        'existencia',
        'precio',
    ];

   
    public function marca(): BelongsTo
    {
        
        return $this->belongsTo(Marca::class);
    }

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }
}
