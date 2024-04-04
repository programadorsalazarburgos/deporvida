<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActivosScope;

class TblDvGrupos extends Model
{

    protected $table      = 'tbl_dv_grupos';
    protected $primarykey = 'id';
    protected $fillable   = ['id_escenario','id_metodologo','id_disciplina','id_comuna_impacto','id_monitor','id_nivel','observaciones','codigo_grupo','fecha_registro','activo'];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ActivosScope);
    }

    public function fk_tbl_dv_escenarios()
	{
        return $this->belongsTo(\App\Models\TblDvEscenarios::class, 'id_escenario');
    }
    public function fk_view_dv_metodologos()
	{
        return $this->belongsTo(\App\Models\ViewDvMetodologos::class, 'id_metodologo');
	}
    public function fk_tbl_dv_disciplinas()
	{
        return $this->belongsTo(\App\Models\TblDvDisciplinas::class, 'id_disciplina');
	}
    public function fk_view_dv_monitores()
    {
        return $this->belongsTo(\App\Models\ViewDvMonitores::class, 'id_monitor');
    }
    public function fk_tbl_dv_niveles()
    {
        return $this->belongsTo(\App\Models\TblDvNiveles::class, 'id_nivel');
    }
}
