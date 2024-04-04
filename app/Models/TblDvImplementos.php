<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvImplementos extends Model
{
	protected $table      = 'tbl_dv_implementos';
    protected $primaryKey = 'id';
    protected $fillable   = ['id','nombre','clasificacion_id','disciplina_id','proveedor_id','stock','especificacion_tecnica', 'cantidad_actual'];
}
