<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblGenPais extends Model
{

    protected $table      = 'paises';
    protected $primaryKey = 'id';
    protected $fillable   = ['iso', 'nombre_pais'];

}
