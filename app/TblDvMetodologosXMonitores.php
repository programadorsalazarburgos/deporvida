<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblDvMetodologosXMonitores extends Model
{
	protected $table      = 'tbl_dv_metodologos_x_monitores';
    protected $primaryKey = 'id';
    protected $fillable   = [
    	'id_monitor',
        'id_metodologo'
    ];
}
