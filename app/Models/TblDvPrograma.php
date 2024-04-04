<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 20 Jan 2018 05:19:45 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class TblDvPersonaXDiscapacidad
 * 
 * @property int $id_persona_x_discapacidad
 * @property int $id_persona
 * @property int $id_discapacidad
 * 
 * @property \App\Models\TblGenPersona $tbl_gen_persona
 * @property \App\Models\TblGenDiscapacidad $tbl_gen_discapacidad
 *
 * @package App\Models
 */
class TblDvPrograma extends Model
{

    protected $table      = 'tbl_dv_programas';
    protected $primaryKey = 'id_programas';
    protected $fillable = [
        'descripcion'
    ];
}
