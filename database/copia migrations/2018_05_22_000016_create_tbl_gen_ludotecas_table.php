<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblGenLudotecasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tbl_gen_ludotecas';

    /**
     * Run the migrations.
     * @table tbl_gen_ludotecas
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre_ludoteca', 191);
            $table->string('telefono', 191);
            $table->string('direccion', 191);
            $table->integer('sede_id')->nullable()->default(null);
            $table->unsignedInteger('barrio_id')->nullable()->default(null);
            $table->unsignedInteger('corregimiento_id')->nullable()->default(null);
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
