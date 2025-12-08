<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at'     => 'datetime',
            'password'          => 'hashed',
        ];
    }

    /**
     * Última vez que inició sesión en formato humano
     */
    public function lastSeenHuman()
    {
        // Si nunca ha iniciado sesión
        if (!$this->last_login_at) {
            return 'Nunca ha iniciado sesión';
        }

        // Gracias al cast, ya es un objeto Carbon
        return $this->last_login_at->diffForHumans();
    }
}
