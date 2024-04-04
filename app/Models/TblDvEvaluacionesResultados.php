<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvEvaluacionesResultados extends Model
{
    protected $table      = 'tbl_dv_evaluaciones_resultados';
    protected $primarykey = 'id';
    protected $fillable   = ['id_evaluacion','id_persona_beneficiario','id_indicador','id_calificacion'];
}
