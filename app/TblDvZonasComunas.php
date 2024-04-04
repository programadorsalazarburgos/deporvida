<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblDvZonasComunas extends Model
{
    
    protected $table = 'tbl_zonas_comunas';
    protected $primarykey = 'id';
    protected $fillable = ['id_zona','id_comuna'];

}
