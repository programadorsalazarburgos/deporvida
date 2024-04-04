<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvEvaluaciones extends Model
{
    protected $table      = 'tbl_dv_evaluaciones';
    protected $primarykey = 'id';
    protected $fillable   = ['id_grupo','fecha','id_evplazoyperiodo'];

    public function fk_tbl_dv_evaluaciones_resultados()
	{
		return $this->hasMany(\App\Models\TblDvEvaluacionesResultados::class, 'id_evaluacion');
    }
    
    public function fk_tbl_dv_grupos()
	{
        return $this->belongsTo(\App\Models\TblDvGrupos::class, 'id_grupo');
    }

    public function fk_tbl_dv_evaluaciones_plazosyperiodos()
	{
        return $this->belongsTo(\App\Models\TblDvEvaluacionesPlazosyperiodos::class, 'id_evplazoyperiodo');
    }

}
