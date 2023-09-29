<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'idUsuario';
    protected $fillable = ['nombres',
        'apellidos',
        'rol',
        'usuario',
        'password',
    ];
    protected $table = 'tblUsuario';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function edad($fechaNac){
        date_default_timezone_set("America/La_Paz");
        $f_fin = date_create(date('Y-m-d'));
        $res = date_diff(date_create($fechaNac), $f_fin);
        return $res->format("%y años %m meses %d dias");
    }

    public function adminlte_image(){
        return asset('vendor/images/user.png');
    }

    public function adminlte_desc(){
        return '';
    }
    public function attributes()
    {
        return $this->attributes;
    }
}
