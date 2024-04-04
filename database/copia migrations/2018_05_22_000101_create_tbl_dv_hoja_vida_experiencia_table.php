<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblDvHojaVidaExperienciaTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tbl_dv_hoja_vida_experiencia';

    /**
     * Run the migrations.
     * @table tbl_dv_hoja_vida_experiencia
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
            $table->string('empresa', 200)->nullable()->default(null);
            $table->string('jefe_inmediato', 200)->nullable()->default(null);
            $table->string('direccion', 200)->nullable()->default(null);
            $table->string('telefono', 200)->nullable()->default(null);
            $table->string('cargo', 200)->nullable()->default(null);
            $table->string('correo_empresa', 200)->nullable()->default(null);
            $table->date('fecha_ingreso')->nullable()->default(null);
            $table->date('fecha_retiro')->nullable()->default(null);
            $table->text('tipo_experiencia')->nullable()->default(null);
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
