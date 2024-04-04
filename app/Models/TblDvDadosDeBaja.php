<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvDadosDeBaja extends Model
{
    protected $table      = 'tbl_dv_dados_de_baja';
    protected $fillable   = ['devolucion_id','implemento_id','dano','perdida_robo','entregado_comunidad'];

}
