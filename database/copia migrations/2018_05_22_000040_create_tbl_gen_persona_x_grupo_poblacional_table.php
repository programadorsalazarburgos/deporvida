<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblGenPersonaXGrupoPoblacionalTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tbl_gen_persona_x_grupo_poblacional';

    /**
     * Run the migrations.
     * @table tbl_gen_persona_x_grupo_poblacional
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('id_persona');
            $table->integer('id_grupo_poblacional');

            $table->index(["id_persona"], 'id_persona');

            $table->index(["id_grupo_poblacional"], 'id_grupo_social');
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
