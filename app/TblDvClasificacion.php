<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblDvClasificacion extends Model
{
    protected $table      = 'tbl_dv_clasificacion_implementos';
    protected $primarykey = 'id';
    protected $fillable   = ['nombre','observaciones','id_disciplina'];

}
