<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblGenContratoCuentaCobroLugar extends Model
{
    protected $table      = 'tbl_gen_contrato_cuenta_cobro_lugar';
	protected $primarykey = 'id';
	protected $fillable   = ['id','lugar','url_imagen','id_gen_contrato_cuenta_cobro'];
} 
