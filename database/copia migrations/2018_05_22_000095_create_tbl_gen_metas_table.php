<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblGenMetasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tbl_gen_metas';

    /**
     * Run the migrations.
     * @table tbl_gen_metas
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre_meta', 191);
            $table->string('periodo', 191);
            $table->unsignedInteger('programa_id');
            $table->integer('meta');
            $table->string('descripcion', 191);

            $table->index(["programa_id"], 'tbl_gen_metas_programa_id_foreign');

            $table->unique(["nombre_meta", "periodo", "programa_id"], 'indice_unicos');
            $table->nullableTimestamps();


            $table->foreign('programa_id', 'tbl_gen_metas_programa_id_foreign')
                ->references('id')->on('programas')
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
