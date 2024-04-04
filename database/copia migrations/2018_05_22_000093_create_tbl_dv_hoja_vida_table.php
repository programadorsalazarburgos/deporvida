<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblDvHojaVidaTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tbl_dv_hoja_vida';

    /**
     * Run the migrations.
     * @table tbl_dv_hoja_vida
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('id_usuario')->nullable()->default(null);
            $table->date('fecha_registro')->nullable()->default(null);
            $table->integer('id_hoja_vida_estado_contrato')->nullable()->default('1');
            $table->text('observacion')->nullable()->default(null);

            $table->index(["id_hoja_vida_estado_contrato"], 'id_hoja_vida_estado_contrato_new');

            $table->index(["id_usuario"], 'id_usuario_new');


            $table->foreign('id_hoja_vida_estado_contrato', 'id_hoja_vida_estado_contrato_new')
                ->references('id')->on('tbl_dv_hoja_vida_estado_contrato')
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
