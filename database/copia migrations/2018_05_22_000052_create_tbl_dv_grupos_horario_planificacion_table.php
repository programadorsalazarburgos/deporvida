<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblDvGruposHorarioPlanificacionTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tbl_dv_grupos_horario_planificacion';

    /**
     * Run the migrations.
     * @table tbl_dv_grupos_horario_planificacion
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
            $table->date('fecha');
            $table->text('eje_tematico');
            $table->text('tema');
            $table->text('objetivo');
            $table->integer('tiempo1');
            $table->integer('tiempo2');
            $table->integer('tiempo3');
            $table->integer('tiempo4');
            $table->text('juego');
            $table->text('habilidades');
            $table->text('ejercicios_introductorios');
            $table->text('juego_correctivo')->nullable()->default(null);
            $table->text('observaciones');
            $table->text('juego_evaluativo');
            $table->text('ejercicios_avanzados')->nullable()->default(null);
            $table->integer('activo')->default('1');
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
