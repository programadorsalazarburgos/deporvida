<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblDvHojaVidaEstudioProfesionalTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tbl_dv_hoja_vida_estudio_profesional';

    /**
     * Run the migrations.
     * @table tbl_dv_hoja_vida_estudio_profesional
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('id_hoja_vida')->nullable()->default(null);
            $table->string('estudio_estado', 20)->nullable()->default(null);
            $table->string('estado_estudio', 200)->nullable()->default(null);
            $table->integer('id_institucion_educativo')->nullable()->default(null);
            $table->string('carrera', 200)->nullable()->default(null);
            $table->integer('id_gen_escolaridad_nivel')->nullable()->default(null);
            $table->date('fecha_grado')->nullable()->default(null);
            $table->integer('id_pais')->nullable()->default(null);
            $table->integer('tarjeta_profesional')->nullable()->default(null);
            $table->text('horario_clases')->nullable()->default(null);
            $table->text('archivos')->nullable()->default(null)->comment('Formato json
[{
   "nombrearchivo":"prueba",
   "url":"direccion/prueba/prueba.jpg"
}]');

            $table->index(["id_hoja_vida"], 'id_hoja_vida');


            $table->foreign('id_hoja_vida', 'id_hoja_vida')
                ->references('id')->on('tbl_dv_hoja_vida')
                ->onDelete('restrict')
                ->onUpdate('restrict');
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
