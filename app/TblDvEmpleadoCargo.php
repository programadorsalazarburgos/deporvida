<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblDvEmpleadoCargo extends Model
{

    protected $table      = 'tbl_dv_empleado_cargo';
    protected $primarykey = 'id';
    protected $fillable   = ['descripcion'];

}
