<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvEvaluacionesPlazosyperiodos extends Model
{
    protected $table      = 'tbl_dv_evaluaciones_plazosyperiodos';
    protected $primarykey = 'id';
    protected $fillable   = ['tipo','nombre','plazo_inicial','plazo_final','periodo_inicial','periodo_final','observaciones'];

    public function fk_tbl_dv_evaluaciones() 
    {
        return $this->hasMany(\App\Models\TblDvEvaluaciones::class, 'id_evplazoyperiodo');
    }

}
