<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblDvAsistenciasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tbl_dv_asistencias';

    /**
     * Run the migrations.
     * @table tbl_dv_asistencias
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('id_grupo');
            $table->integer('id_persona_beneficiario');
            $table->date('fecha_asistencia');
            $table->timestamp('fecha_creacion')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('siasistio')->comment('1=Si asistio
0=No asistio');
            $table->string('observacion', 20)->nullable()->default(null);

            $table->index(["id_grupo"], 'id_grupo');
            $table->nullableTimestamps();
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
