<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblCmCriteriosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tbl_cm_criterios';

    /**
     * Run the migrations.
     * @table tbl_cm_criterios
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('grupo_id')->nullable()->default(null);
            $table->string('nombre_criterio', 200);
            $table->string('tenantId', 20);

            $table->index(["grupo_id"], 'tbl_cm_criterios_grupo_id_foreign');
            $table->nullableTimestamps();


            $table->foreign('grupo_id', 'tbl_cm_criterios_grupo_id_foreign')
                ->references('id')->on('grupos')
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
