<?php

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

class TblDvPersonal extends Eloquent
{

    protected $table      = 'tbl_dv_personal';
    protected $primaryKey = 'id_personal';
    public $timestamps    = false;
    protected $fillable   = [
        'id_personal', 
        'id_persona', 
        'id_presupuesto', 
        'id_rol', 
        'libreta_tipo', 
        'libreta_numero', 
        'distrito_militar', 
        'proyecto_profesional', 
        'skype'
    ];

}
