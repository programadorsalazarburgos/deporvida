<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblDvEmpleadoXGrupoPoblacional extends Model
{

    protected $table      = 'tbl_dv_empleado_x_grupo_poblacional';
    protected $primarykey = 'id';
    protected $fillable   = ['id_ficha_empleado','id_gen_grupo_poblacional'];

}
