<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitucionesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'instituciones';

    /**
     * Run the migrations.
     * @table instituciones
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre_institucion', 191);
            $table->string('codigo_dane', 191)->nullable()->default(null);
            $table->string('telefono', 191);
            $table->string('direccion', 191);
            $table->string('nombre_rector', 191)->nullable()->default(null);
            $table->unsignedInteger('barrio_id')->nullable()->default(null);
            $table->unsignedInteger('corregimiento_id')->nullable()->default(null);

            $table->index(["barrio_id"], 'instituciones_barrio_id_foreign');

            $table->index(["corregimiento_id"], 'corregimiento_id');
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
