<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblCmPersonaXDiscapacidadTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tbl_cm_persona_x_discapacidad';

    /**
     * Run the migrations.
     * @table tbl_cm_persona_x_discapacidad
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('ficha_id')->nullable()->default(null);
            $table->unsignedInteger('discapacidad_id')->nullable()->default(null);

            $table->index(["ficha_id"], 'tbl_cm_persona_x_discapacidad_ficha_id_foreign');

            $table->index(["discapacidad_id"], 'tbl_cm_persona_x_discapacidad_discapacidad_id_foreign');
            $table->nullableTimestamps();


            $table->foreign('discapacidad_id', 'tbl_cm_persona_x_discapacidad_discapacidad_id_foreign')
                ->references('id')->on('tbl_gen_discapacidad')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('ficha_id', 'tbl_cm_persona_x_discapacidad_ficha_id_foreign')
                ->references('id')->on('tbl_cm_ficha')
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
