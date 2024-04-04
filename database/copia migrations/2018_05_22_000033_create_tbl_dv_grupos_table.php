<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblDvGruposTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tbl_dv_grupos';

    /**
     * Run the migrations.
     * @table tbl_dv_grupos
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('id_escenario')->nullable()->default(null);
            $table->integer('id_metodologo');
            $table->integer('id_disciplina')->nullable()->default(null);
            $table->integer('id_monitor')->nullable()->default(null);
            $table->integer('id_comuna_impacto')->nullable()->default(null);
            $table->integer('id_nivel')->nullable()->default(null);
            $table->string('observaciones', 191)->nullable()->default('');
            $table->string('codigo_grupo', 10)->nullable()->default(null);
            $table->timestamp('fecha_registro')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('activo')->nullable()->default('1')->comment('1=Si esta activo
0=No esta activo');
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
