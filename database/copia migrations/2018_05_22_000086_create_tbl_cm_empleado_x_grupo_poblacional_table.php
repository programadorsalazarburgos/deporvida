<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblCmEmpleadoXGrupoPoblacionalTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tbl_cm_empleado_x_grupo_poblacional';

    /**
     * Run the migrations.
     * @table tbl_cm_empleado_x_grupo_poblacional
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('empleado_id')->nullable()->default(null);
            $table->unsignedInteger('grupopoblacional_id')->nullable()->default(null);

            $table->index(["empleado_id"], 'tbl_cm_empleado_x_grupo_poblacional_empleado_id_foreign');

            $table->index(["grupopoblacional_id"], 'tbl_cm_empleado_x_grupo_poblacional_grupopoblacional_id_foreign');
            $table->nullableTimestamps();


            $table->foreign('empleado_id', 'tbl_cm_empleado_x_grupo_poblacional_empleado_id_foreign')
                ->references('id')->on('tbl_cm_empleado')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('grupopoblacional_id', 'tbl_cm_empleado_x_grupo_poblacional_grupopoblacional_id_foreign')
                ->references('id')->on('tbl_cm_grupo_poblacional')
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
