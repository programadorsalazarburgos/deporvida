<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblDvHojaVidaEstadoContratoTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tbl_dv_hoja_vida_estado_contrato';

    /**
     * Run the migrations.
     * @table tbl_dv_hoja_vida_estado_contrato
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('descripcion', 200)->nullable()->default(null);
            $table->integer('orden')->nullable()->default(null);
            $table->text('archivos')->nullable()->default(null)->comment('Formato json
[{
   "nombrearchivo":"prueba",
   "url":"direccion/prueba/prueba.jpg"
}]');
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
