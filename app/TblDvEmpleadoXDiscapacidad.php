<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblDvEmpleadoXDiscapacidad extends Model
{

    protected $table      = 'tbl_dv_empleado_x_discapacidad';
    protected $primarykey = 'id';
    protected $fillable   = ['id_empleado', 'id_discapacidad'];

}
