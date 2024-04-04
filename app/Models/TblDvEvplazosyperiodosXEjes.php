<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvEvplazosyperiodosXEjes extends Model
{
    protected $table      = 'tbl_dv_evplazosyperiodos_x_ejes';
    protected $primarykey = 'id';
    protected $fillable   = ['id_evplazoyperiodo','id_eje'];

    public function fk_tbl_dv_ejes_tematicos() 
    {
        return $this->belongsTo(\App\Models\TblDvEjesTematicos::class, 'id_eje');
    }
}
