<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HorarioGrupo extends Model
{

    protected $table      = 'tbl_dv_grupos_horario';
    protected $primarykey = 'id';
    protected $fillable   = ['id_grupo', 'dia', 'hora_inicio', 'hora_fin', 'id_equipamiento'];

}
