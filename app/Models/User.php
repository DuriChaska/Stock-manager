<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use App\Models\Role;


class User extends Authenticatable
{
    use Notifiable;
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

    //ultima vez que inicio sesio n en formato humano

    public function lastSeenHuman()
    {
        // si nunca ha iniciado sesión
        if (!$this->last_login_at) {
            return 'Nunca ha iniciado sesión';
        }

        
        return $this->last_login_at->diffForHumans();
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    protected $dates = ['last_login_at'];

}
