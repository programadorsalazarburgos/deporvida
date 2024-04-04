<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvHojaVidaIdiomas extends Model
{

    protected $table      = 'tbl_dv_hoja_vida_idiomas';
    protected $primaryKey = 'id';
    public $timestamps    = false;
    protected $fillable   = [
        'id',
		'id_hoja_vida',
		'id_idioma'
    ];

}
