<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvHojaVidaCarreras extends Model
{
    protected $table      = 'tbl_dv_hoja_vida_carreras';
    protected $primaryKey = 'id';
    public $timestamps    = false;
    protected $fillable   = [
        'id',
		'descripcion'
    ];

}
