<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorarioGruposTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'horario_grupos';

    /**
     * Run the migrations.
     * @table horario_grupos
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('grupo_id');
            $table->string('dia', 191);
            $table->time('hora_inicio');
            $table->time('hora_fin');

            $table->index(["grupo_id"], 'horario_grupos_grupo_id_foreign');
            $table->nullableTimestamps();


            $table->foreign('grupo_id', 'horario_grupos_grupo_id_foreign')
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
