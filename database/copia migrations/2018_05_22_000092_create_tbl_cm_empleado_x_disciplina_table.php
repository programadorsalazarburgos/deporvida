<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblCmEmpleadoXDisciplinaTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tbl_cm_empleado_x_disciplina';

    /**
     * Run the migrations.
     * @table tbl_cm_empleado_x_disciplina
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
            $table->unsignedInteger('disciplina_id')->nullable()->default(null);

            $table->index(["empleado_id"], 'tbl_cm_empleado_x_disciplina_empleado_id_foreign');
            $table->nullableTimestamps();


            $table->foreign('empleado_id', 'tbl_cm_empleado_x_disciplina_empleado_id_foreign')
                ->references('id')->on('tbl_cm_empleado')
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
