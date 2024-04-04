<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 20 Jan 2018 05:19:45 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
    protected $table = 'users';
    protected $primarykey = 'id';
	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'primer_nombre',
		'email',
		'segundo_nombre',
		'primer_apellido',
		'segundo_apellido',
		'tipo_documento',
		'numero_documento',
		'direccion',
		'fecha_nacimiento',
		'telefono_movil',
		'telefono_fijo',
		'tenantId'
	];
}
