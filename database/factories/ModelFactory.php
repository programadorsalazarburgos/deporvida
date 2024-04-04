<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
// $factory->define(App\User::class, function (Faker\Generator $faker) {
//     static $password;

//     return [
//         'name' => $faker->name,
//         'email' => $faker->unique()->safeEmail,
//         'password' => $password ?: $password = bcrypt('secret'),
//         'remember_token' => str_random(10),
//     ];
// });


$factory->define(App\Beneficiario::class, function (Faker\Generator $faker) {
    

    return [
    
		'grupo_id'=> 6, 
     	'fecha_inscripcion'=> '2018-01-09 19:28:21', 
     	'no_ficha'=> $faker->unique()->randomNumber($nbDigits = NULL), 
     	'programa_id'=> 3, 
     	'modalidad'=> 'deporte', 
     	'punto_atencion'=> 'secretaria', 
     	'nombres_beneficiario'=> $faker->name, 
     	'apellidos_beneficiario'=> $faker->lastName, 
     	'tipo_documento_beneficiario'=> 1, 
     	'no_documento_beneficiario'=> $faker->randomNumber($nbDigits = NULL),
     	'sexo_beneficiario'=> 1, 
     	'fecha_nac_beneficiario'=> '1990-05-30 19:28:21', 
     	'sexo_beneficiario'=> 1, 
     	'edad_beneficiario'=> 28, 
     	'telefono_beneficiario'=> $faker->phoneNumber,
     	'correo_beneficiario'=> $faker->unique()->safeEmail,
     	'pais_id'=> 1, 
     	'departamento_id'=> 76, 
     	'municipio_id'=> 1, 
     	'direccion_beneficiario'=> $faker->address(4), 
     	'estrato_beneficiario'=> 'dos', 
     	'comuna_id'=> 1, 
     	'barrio_id'=> 1, 
     	'corregimiento_beneficiario'=> 'planila', 
     	'vereda_beneficiario'=> 'lasvegas', 
     	'estado_civil_beneficiario'=>0, 
     	'hijos_beneficiario'=>0, 
     	'cantidad_hijos_beneficiario'=>0, 
     	'tipo_sangre_beneficiario'=>1, 
     	'ocupacion_beneficiario'=>1, 
     	'otra_ocupacion_beneficiario'=>1, 
     	'escolaridad_beneficiario'=>1, 
     	'cultura_beneficiario'=>1, 
     	'otra_cultura_beneficiario'=>1, 
     	'discapacidad_beneficiario'=>1, 
     	'discapacidad_select_beneficiario'=>1, 
     	'otra_discapacidad_beneficiario'=>1, 
     	'enfermedad_permanente_beneficiario'=>1, 
     	'enfermedad_beneficiario'=>1, 
     	'medicamentos_permanente_beneficiario'=>1, 
     	'medicamentos_beneficiario'=>1, 
     	'seguridad_social_beneficiario'=>1, 
     	'salud_sgsss_beneficiario'=>1, 
     	'nombre_seguridad_beneficiario'=>'siempre', 
     	'nombres_acudiente'=>$faker->name, 
     	'apellidos_acudiente'=>$faker->lastName, 
     	'tipo_doc_acudiente'=>1, 
     	'documento_acudiente'=>str_random(12),  
     	'sexo_acudiente'=>1, 
     	'fecha_nac_acudiente'=>'1986-05-30 19:28:21',  
     	'edad_acudiente'=>28, 
     	'telefono_acudiente'=>$faker->phoneNumber,
     	'correo_acudiente'=>$faker->unique()->safeEmail,
     	'parentesco_acudiente'=>1, 
     	'otro_parentesco_acudiente'=>'amigo', 


    ];
});

