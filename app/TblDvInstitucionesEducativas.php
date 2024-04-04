<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblDvInstitucionesEducativas extends Model
{

    protected $table      = 'tbl_dv_instituciones_educativas';
    protected $primarykey = 'id';
    protected $fillable   = ['nombre'];

}
