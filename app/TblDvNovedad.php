<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblDvNovedad extends Model
{
    protected $table      = 'tbl_dv_novedad';
    protected $primarykey = 'id';
    protected $fillable   = ['id_novedad_tipo','nombre','detalle','id_usuario_monitor','fecha_reportar','fecha_creacion','id_grupo'];
}
