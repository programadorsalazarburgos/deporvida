<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblGenAsistenciasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tbl_gen_asistencias';

    /**
     * Run the migrations.
     * @table tbl_gen_asistencias
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->date('fecha_asistencia');
            $table->unsignedInteger('grupo_id')->nullable()->default(null);
            $table->unsignedInteger('ficha_id')->nullable()->default(null);
            $table->string('observaciones')->nullable()->default(null);
            $table->tinyInteger('asistencia');
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
