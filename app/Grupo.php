<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{

    protected $table      = 'tbl_dv_grupos';
    protected $primarykey = 'id';
    protected $fillable   = ['id_escenario', 'id_metodologo', 'id_monitor', 'id_disciplina', 'id_nivel', 'observaciones', 'codigo_grupo', 'id_comuna_impacto'];

}
