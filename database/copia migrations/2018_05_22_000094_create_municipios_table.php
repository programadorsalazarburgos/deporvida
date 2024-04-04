<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMunicipiosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'municipios';

    /**
     * Run the migrations.
     * @table municipios
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre_municipio', 191);
            $table->unsignedInteger('departamento_id');
            $table->string('cod_municipio', 10)->nullable()->default(null);

            $table->index(["departamento_id"], 'municipios_departamento_id_foreign');
            $table->nullableTimestamps();


            $table->foreign('departamento_id', 'municipios_departamento_id_foreign')
                ->references('id')->on('departamentos')
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
