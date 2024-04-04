<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvDeatalleEntrada extends Model
{
    protected $table      = 'tbl_dv_deatalle_entrada';
    protected $primarykey = 'id';
    protected $fillable   = ['entrada_id','implemento_id','cantidad'];
}
