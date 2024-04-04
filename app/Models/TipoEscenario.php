<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvTipoEscenarios extends Model
{
    
    protected $table = 'tbl_dv_tipo_escenarios';
    protected $primarykey = 'id';
    protected $fillable = ['nombre_tipo_escenario'];

}
