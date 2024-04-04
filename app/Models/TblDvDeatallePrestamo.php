<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvDeatallePrestamo extends Model
{
    protected $table      = 'tbl_dv_deatalle_prestamo';
    protected $primarykey = 'id';
    protected $fillable   = ['prestamo_id','implemento_id','cantidad'];
}
