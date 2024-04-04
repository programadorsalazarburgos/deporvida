<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblDvEmpleadoXDisciplina extends Model
{

    protected $table      = 'tbl_dv_empleado_x_disciplina';
    protected $primarykey = 'id';
    protected $fillable   = ['id_empleado', 'id_disciplina'];

}
