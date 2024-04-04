<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblDvHojaVidaIdiomasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tbl_dv_hoja_vida_idiomas';

    /**
     * Run the migrations.
     * @table tbl_dv_hoja_vida_idiomas
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('id_idioma')->nullable()->default(null);
            $table->integer('id_hoja_vida')->nullable()->default(null);

            $table->index(["id_idioma"], 'id_idioma');

            $table->index(["id_hoja_vida"], 'id_hoja_vida');


            $table->foreign('id_idioma', 'id_idioma')
                ->references('id')->on('tbl_gen_idiomas')
                ->onDelete('restrict')
                ->onUpdate('restrict');

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
