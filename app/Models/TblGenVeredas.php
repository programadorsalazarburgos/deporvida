<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblGenVeredas extends Model
{
    protected $table      = 'tbl_gen_veredas';
    protected $primarykey = 'id';
    protected $fillable   = ['id','id_comuna','nombre','codigo_unico','codigo_estudio','estrato','corregimiento_id'];
}
