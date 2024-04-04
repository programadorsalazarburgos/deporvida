<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvConfig extends Model
{

    protected $table      = 'tbl_dv_config';
    protected $primarykey = 'id';
    protected $fillable   = ['name','value'];
}
