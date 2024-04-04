<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActivosScope;

class TblDvGruposhistoricoEvolucion extends Model
{

    protected $table      = 'tbl_dv_grupos_historico_evolucion';
    protected $primarykey = 'id';
    protected $fillable   = 
    [
        'id_escenario',
        'id_metodologo',
        'id_grupo',
        'id_disciplina',
        'id_comuna_impacto',
        'id_monitor',
        'id_nivel',
        'id_usuario_genera_cambio',
        'observaciones',
        'codigo_grupo',
        'fecha_registro',
        'activo',
        'fecha_reasignacion'
    ];
}
