<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblDvEmpleadoXComuna extends Model
{

    protected $table      = 'tbl_dv_empleado_x_comuna';
    protected $primarykey = 'id';
    protected $fillable   = ['id_ficha_empleado', 'id_comuna'];

}
