<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvHojaVida extends Model
{

    protected $table      = 'tbl_dv_hoja_vida';
    protected $primaryKey = 'id';
    public $timestamps    = false;
    protected $fillable   = [
        'id',
		'id_usuario',
		'fecha_registro',
		'archivos'
    ];

}
