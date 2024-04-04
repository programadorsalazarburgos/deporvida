<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoEscenario extends Model
{
    
    protected $table = 'tbl_dv_tipo_escenarios';
    protected $primarykey = 'id';
    protected $fillable = ['nombre_tipo_escenario'];

}
