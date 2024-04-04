<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvTipoEscenarios extends Model
{
        protected $table      = 'tbl_dv_tipo_escenarios';
        protected $primaryKey = 'id';
        public $timestamps    = false;
        protected $fillable   = [
            'id',
            'nombre_tipo_escenario'
        ];
    
}
