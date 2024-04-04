<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSedesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'sedes';

    /**
     * Run the migrations.
     * @table sedes
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('institucion_id');
            $table->string('nombre_sede', 191);
            $table->string('direccion', 191)->nullable()->default(null);
            $table->string('telefono_sede', 50)->nullable()->default(null);
            $table->string('correo_sede', 100)->nullable()->default(null);

            $table->index(["institucion_id"], 'sedes_institucion_id_foreign');


            $table->foreign('institucion_id', 'sedes_institucion_id_foreign')
                ->references('id')->on('instituciones')
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
