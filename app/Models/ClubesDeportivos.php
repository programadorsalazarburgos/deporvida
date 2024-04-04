<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 24 06 2021 05:19:45 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class ClubesDeportivos
 * 
 * @property int $id
 * @property string $nombre_club
 * 
 * @property \Illuminate\Database\Eloquent\Collection $tbl_gen_persona_x_grupo_poblacionals
 *
 * @package App\Models
 */
class ClubesDeportivos extends Model
{
	protected $table = 'clubes_deportivos';
	protected $primaryKey = 'id';
	public $timestamps = false;

	protected $fillable = [
		'nombre_club'
	];

}
