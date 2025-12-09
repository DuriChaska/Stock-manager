<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    

    protected $fillable = [
        'nombre',
        
        'precio',
        'existencia',
        'proveedor_id',
        'marca_id',
        'talla',
        'imagen',
    ];



    public function marca()
    {

        return $this->belongsTo(Marca::class);
    }


    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }


    public function movimientos()
    {
        return $this->hasMany(Movimiento::class, 'producto_id');
    }
}
