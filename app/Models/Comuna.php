<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comuna extends Model
{
    
    protected $table = 'comunas';
    protected $primarykey = 'id';
    protected $fillable = ['codigo_comuna', 'nombre_comuna', 'zona_id'];

}


