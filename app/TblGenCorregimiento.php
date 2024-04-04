<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblGenCorregimiento extends Model
{

    protected $table      = 'tbl_gen_corregimientos';
    protected $primarykey = 'id';
    protected $fillable   = ['id_municipio', 'descripcion'];

}
