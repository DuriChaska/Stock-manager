<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Usuario extends Authenticatable 
{
   
    public function rol(): BelongsTo
    {
        return $this->belongsTo(Rol::class);
    }
    
    // Un Usuario realiza muchos Movimientos
    public function movimientos(): HasMany
    {
        return $this->hasMany(Movimiento::class);
    }

}
