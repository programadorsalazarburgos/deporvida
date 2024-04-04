<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MotivoDesvinculacion extends Model
{
    
    protected $table      = 'tbl_motivos_desvinculaciones';
    protected $primarykey = 'id';
    protected $fillable   = ['nombre'];

}
