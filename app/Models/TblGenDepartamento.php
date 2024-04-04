<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblGenDepartamento extends Model
{

    protected $table      = 'departamentos';
    protected $primaryKey = 'id';
    protected $fillable   = ['nombre_departamento','pais_id'];

}
