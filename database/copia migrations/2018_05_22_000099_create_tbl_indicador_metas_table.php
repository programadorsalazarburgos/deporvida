<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblIndicadorMetasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tbl_indicador_metas';

    /**
     * Run the migrations.
     * @table tbl_indicador_metas
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('meta_id');
            $table->string('mes', 191);
            $table->integer('avance_meta');
            $table->text('descripcion')->nullable()->default(null);

            $table->unique(["meta_id", "mes"], 'indice_unicos');
            $table->nullableTimestamps();


            $table->foreign('meta_id', 'indice_unicos')
                ->references('id')->on('tbl_gen_metas')
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
