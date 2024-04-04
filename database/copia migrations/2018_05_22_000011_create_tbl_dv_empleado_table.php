<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblDvEmpleadoTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tbl_dv_empleado';

    /**
     * Run the migrations.
     * @table tbl_dv_empleado
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('id_persona')->nullable()->default(null);
            $table->integer('id_usuario');
            $table->integer('id_estado_aspirante')->default('1');
            $table->integer('tiene_hijos')->nullable()->default(null)->comment('0: No, 1: Si');
            $table->integer('cuantos_hijos')->nullable()->default(null);
            $table->string('libreta_militar', 20)->nullable()->default(null);
            $table->string('no_libreta_militar', 250)->nullable()->default(null);
            $table->string('distrito_militar', 250)->nullable()->default(null);
            $table->string('skype', 50)->nullable()->default(null);
            $table->integer('id_disponibilidad')->nullable()->default(null)->comment('1. Total 2. Parcial');
            $table->string('foto', 100)->nullable()->default(null)->comment('Nombre del Archivo adjunto (Ej:  nombreafotomd5.jpg  )');
            $table->string('profesion', 100)->nullable()->default(null);
            $table->integer('id_disciplina')->nullable()->default(null);
            $table->integer('id_ocupacion')->nullable()->default(null);
            $table->integer('tiene_discapacidad')->nullable()->default(null)->comment('0: No, 1: Si');
            $table->integer('padece_enfermedad')->nullable()->default(null)->comment('0: No, 1: Si');
            $table->string('enfermedad')->nullable()->default(null);
            $table->integer('toma_medicamentos')->nullable()->default(null)->comment('0: No, 1: Si');
            $table->string('medicamentos')->nullable()->default(null);
            $table->integer('afiliado_sgsss')->nullable()->default(null)->comment('0: No, 1: Si');
            $table->integer('id_tipo_afiliacion')->nullable()->default(null)->comment('1: Regimen contributivo (EPS), 2: Regimen subcidiado (SISBEN), 3: Especial (FFMM, Policia)');
            $table->string('id_eps')->nullable()->default(null);
            $table->text('proyecto_profesional')->nullable()->default(null)->comment('Descripcion donde el usuario escribe su proyecto profesional hacia el futuro..');
            $table->integer('id_cargo')->nullable()->default(null)->comment('FK Tabla Cargos');
            $table->integer('id_escolaridad_nivel')->nullable()->default(null)->comment('1: Bachiller, 2: T?cnico, 3: Tecnol?gico, 4: Universitario, 5: Postgrado, 6: Maestria, 7:  Curso, 8: Diplomado, 9: Certificado DUNT, 10: Otro');
            $table->integer('id_etnia')->nullable()->default(null);
            $table->integer('id_institucion_educativa')->nullable()->default(null);
            $table->integer('activo')->nullable()->default('1')->comment('1=no activo
0=no activo');
            $table->integer('id_presupuesto')->nullable()->default(null);
            $table->integer('id_estado_escolaridad')->nullable()->default(null);
            $table->integer('nuevo')->nullable()->default('1')->comment('1=nuevo
0=actualizado');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
