<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TblDvNiveles extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table      = 'tbl_dv_niveles';
    protected $primarykey = 'id';
    protected $fillable   = ['descripcion', 'observaciones'];
}
