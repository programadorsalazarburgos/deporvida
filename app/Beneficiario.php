<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Beneficiario extends Model
{
    

    protected $table = 'beneficiarios';
    protected $primarykey = 'id';
    protected $fillable =

     [
          
          'grupo_id', 
     	'fecha_inscripcion', 
     	'no_ficha', 
     	'programa_id', 
     	'modalidad', 
     	'punto_atencion', 
     	'nombres_beneficiario', 
     	'apellidos_beneficiario', 
     	'tipo_documento_beneficiario', 
     	'no_documento_beneficiario', 
     	'sexo_beneficiario', 
     	'fecha_nac_beneficiario', 
     	'sexo_beneficiario', 
     	'edad_beneficiario', 
     	'telefono_beneficiario', 
     	'correo_beneficiario', 
     	'pais_id', 
     	'departamento_id', 
     	'municipio_id', 
     	'direccion_beneficiario', 
     	'estrato_beneficiario', 
     	'comuna_id', 
     	'barrio_id', 
     	'corregimiento_beneficiario', 
     	'vereda_beneficiario', 
     	'estado_civil_beneficiario', 
     	'hijos_beneficiario', 
     	'cantidad_hijos_beneficiario', 
     	'tipo_sangre_beneficiario', 
     	'ocupacion_beneficiario', 
     	'otra_ocupacion_beneficiario', 
     	'escolaridad_beneficiario', 
     	'cultura_beneficiario', 
     	'otra_cultura_beneficiario', 
     	'discapacidad_beneficiario', 
     	'discapacidad_select_beneficiario', 
     	'otra_discapacidad_beneficiario', 
     	'enfermedad_permanente_beneficiario', 
     	'enfermedad_beneficiario', 
     	'medicamentos_permanente_beneficiario', 
     	'medicamentos_beneficiario', 
     	'seguridad_social_beneficiario', 
     	'salud_sgsss_beneficiario', 
     	'nombre_seguridad_beneficiario', 
     	'nombres_acudiente', 
     	'apellidos_acudiente', 
     	'tipo_doc_acudiente', 
     	'documento_acudiente', 
     	'sexo_acudiente', 
     	'fecha_nac_acudiente', 
     	'edad_acudiente', 
     	'telefono_acudiente', 
     	'correo_acudiente', 
     	'parentesco_acudiente', 
     	'otro_parentesco_acudiente' 
     
     ];

     // function getFechaInscripcionAttribute($value)
     // {
     //     return Carbon::parse($value)->format('d/m/Y');
     // }


}












