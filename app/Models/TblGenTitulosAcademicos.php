<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblGenTitulosAcademicos extends Model
{
    protected $table      = 'tbl_gen_titulos_academicos';
	protected $primaryKey = 'id';
	protected $fillable   = ['id','descripcion'];
}
