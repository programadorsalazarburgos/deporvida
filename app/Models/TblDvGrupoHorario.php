<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvGrupoHorario extends Model
{

    protected $table      = 'tbl_dv_grupos_horario';
    protected $primarykey = 'id';
    protected $fillable   = ['id_grupo', 'dia', 'hora_inicio', 'hora_fin'];
    
}
