<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblGenCorregmientos extends Model
{
    protected $table      = 'tbl_gen_corregimientos';
    protected $primarykey = 'id';
    protected $fillable   = ['id','codigo_unico','descripcion','estrato'];
}
