<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblCmEvaluacionesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tbl_cm_evaluaciones';

    /**
     * Run the migrations.
     * @table tbl_cm_evaluaciones
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
            $table->unsignedInteger('ficha_id')->nullable()->default(null);
            $table->unsignedInteger('criterio_id')->nullable()->default(null);
            $table->integer('valor_evaluacion');
            $table->date('fecha_evaluacion');
            $table->string('tenantId', 20);

            $table->index(["criterio_id"], 'tbl_cm_evaluaciones_criterio_id_foreign');

            $table->index(["ficha_id"], 'tbl_cm_evaluaciones_ficha_id_foreign');

            $table->index(["grupo_id"], 'tbl_cm_evaluaciones_grupo_id_foreign');
            $table->nullableTimestamps();


            $table->foreign('criterio_id', 'tbl_cm_evaluaciones_criterio_id_foreign')
                ->references('id')->on('tbl_cm_criterios')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('ficha_id', 'tbl_cm_evaluaciones_ficha_id_foreign')
                ->references('id')->on('tbl_cm_ficha')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('grupo_id', 'tbl_cm_evaluaciones_grupo_id_foreign')
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
