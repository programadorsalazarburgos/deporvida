<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'primer_nombre', 
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido', 
        'tipo_documento', 
        'numero_documento', 
        'direccion',
        'fecha_nacimiento', 
        'telefono_movil', 
        'telefono_fijo', 
        'email', 
        'password',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


     //  function getFechaNacimientoAttribute($value)
     // {
     //     return Carbon::parse($value)->format('d/m/Y');
     // }

}
