<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblCmColegiosXImplementosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tbl_cm_colegios_x_implementos';

    /**
     * Run the migrations.
     * @table tbl_cm_colegios_x_implementos
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('sede_id');
            $table->unsignedInteger('implemento_id');
            $table->integer('cantidad');

            $table->index(["implemento_id"], 'tbl_cm_colegios_x_implementos_implemento_id_foreign');

            $table->index(["sede_id"], 'tbl_cm_colegios_x_implementos_sede_id_foreign');
            $table->nullableTimestamps();


            $table->foreign('implemento_id', 'tbl_cm_colegios_x_implementos_implemento_id_foreign')
                ->references('id')->on('tbl_cm_implementos')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('sede_id', 'tbl_cm_colegios_x_implementos_sede_id_foreign')
                ->references('id')->on('sedes')
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
