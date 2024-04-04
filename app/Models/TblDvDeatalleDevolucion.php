<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvDeatalleDevolucion extends Model
{
    protected $table      = 'tbl_dv_deatalle_devolucion';
    protected $fillable   = ['entrada_id','implemento_id','cantidad'];
}
