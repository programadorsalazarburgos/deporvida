<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblDvHojaVidaEstudioNoFormalTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tbl_dv_hoja_vida_estudio_no_formal';

    /**
     * Run the migrations.
     * @table tbl_dv_hoja_vida_estudio_no_formal
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('id_hoja_vida');
            $table->integer('id_institucion_educativo');
            $table->integer('horas_cursadas');
            $table->string('curso_tipo', 20)->nullable()->default(null);
            $table->string('titulo', 200)->nullable()->default(null);
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
