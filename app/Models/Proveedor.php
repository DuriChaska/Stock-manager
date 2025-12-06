<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proveedor extends Model
{
    public function movimientos(): HasMany
    {
        return $this->hasMany(Movimiento::class);
    }
}
