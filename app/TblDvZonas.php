<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblDvZonas extends Model
{
    

    protected $table = 'tbl_dv_zonas';
    protected $primarykey = 'id';
    protected $fillable = ['nombre_zona'];

}
