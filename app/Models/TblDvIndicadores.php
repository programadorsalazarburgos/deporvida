<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvIndicadores extends Model
{
    protected $table      = 'tbl_dv_indicadores';
    protected $primarykey = 'id';
    protected $fillable   = ['id_eje','id_nivel','id_disciplina','nombre','observaciones'];

    public function fk_tbl_dv_ejes_tematicos()
    {
        return $this->belongsTo(\App\Models\TblDvEjesTematicos::class, 'id_eje');
    }

    public function fk_tbl_dv_niveles()
    {
        return $this->belongsTo(\App\Models\TblDvNiveles::class, 'id_nivel');
    }

    public function fk_tbl_dv_disciplinas()
    {
        return $this->belongsTo(\App\Models\TblDvDisciplinas::class, 'id_disciplina');
    }

}

