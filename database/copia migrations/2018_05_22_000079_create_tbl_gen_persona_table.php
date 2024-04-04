<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblGenPersonaTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tbl_gen_persona';

    /**
     * Run the migrations.
     * @table tbl_gen_persona
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre_primero', 200);
            $table->string('nombre_segundo', 200)->nullable()->default(null);
            $table->string('apellido_primero', 200)->nullable()->default(null);
            $table->string('apellido_segundo', 200)->nullable()->default(null);
            $table->string('documento', 100);
            $table->integer('id_documento_tipo')->nullable()->default(null);
            $table->string('sexo', 1)->nullable()->default(null)->comment('1=Hombre
2=mujer');
            $table->string('fecha_nacimiento', 200)->nullable()->default(null);
            $table->string('telefono_fijo', 200)->nullable()->default(null);
            $table->string('telefono_movil', 200)->nullable()->default(null);
            $table->string('correo_electronico', 200)->nullable()->default(null);
            $table->integer('id_procedencia_pais')->nullable()->default(null);
            $table->integer('id_procedencia_municipio')->nullable()->default(null);
            $table->integer('id_procedencia_departamento')->nullable()->default(null);
            $table->integer('id_residencia_corregimiento')->nullable()->default(null);
            $table->string('otro_municipio', 50)->nullable()->default(null);
            $table->integer('id_residencia_barrio')->nullable()->default(null);
            $table->integer('id_residencia_vereda')->nullable()->default(null);
            $table->string('residencia_direccion', 200)->nullable()->default(null);
            $table->string('residencia_estrato', 2)->nullable()->default(null);
            $table->enum('sangre_tipo', ['O+', 'O-', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'])->nullable()->default(null);
            $table->integer('id_estado_civil')->nullable()->default(null);
            $table->string('tenantId', 20)->nullable()->default(null);
            $table->string('other_municipio_nombre', 100)->nullable()->default(null);

            $table->index(["id_documento_tipo"], 'id_documento_tipo');
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
