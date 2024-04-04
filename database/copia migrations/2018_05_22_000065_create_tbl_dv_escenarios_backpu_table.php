<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblDvEscenariosBackpuTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tbl_dv_escenarios_backpu';

    /**
     * Run the migrations.
     * @table tbl_dv_escenarios_backpu
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('tipoescenario_id');
            $table->string('direccion', 200)->nullable()->default(null);
            $table->string('direccion_complemento', 200)->nullable()->default(null);
            $table->integer('id_corregimiento')->nullable()->default(null);
            $table->integer('id_vereda')->nullable()->default(null);
            $table->integer('id_barrio')->nullable()->default(null);
            $table->string('nombre_escenario', 191);
            $table->text('descripcion')->nullable()->default(null);
            $table->integer('activo')->default('1')->comment('1=activo, 0=eliminado');
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
