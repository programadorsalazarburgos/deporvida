<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 20 Jan 2018 05:19:45 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class TblGenSaludRegiman
 * 
 * @property int $id
 * @property string $descripcion
 * 
 * @property \Illuminate\Database\Eloquent\Collection $tbl_dv_fichas
 *
 * @package App\Models
 */
class TblGenSaludRegiman extends Model
{
	protected $table      = 'tbl_gen_salud_regimen';
    protected $primaryKey = 'id';
    protected $fillable   = ['descripcion'];

}
