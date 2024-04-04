<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblCmEmpleadoTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tbl_cm_empleado';

    /**
     * Run the migrations.
     * @table tbl_cm_empleado
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('id_persona')->nullable()->default(null);
            $table->unsignedInteger('id_usuario')->nullable()->default(null);
            $table->integer('hijos_beneficiario')->nullable()->default(null);
            $table->integer('cantidad_hijos_beneficiario')->nullable()->default(null);
            $table->integer('ocupacion_beneficiario')->nullable()->default(null);
            $table->unsignedInteger('escolaridad_id')->nullable()->default(null);
            $table->integer('estado_escolaridad')->nullable()->default(null);
            $table->string('titulo_obtenido', 191)->nullable()->default(null);
            $table->unsignedInteger('universidad_id')->nullable()->default(null);
            $table->unsignedInteger('ocupacion_id')->nullable()->default(null);
            $table->integer('hijos_empleado')->nullable()->default(null);
            $table->integer('cantidad_hijos')->nullable()->default(null);
            $table->unsignedInteger('etnia_id')->nullable()->default(null);
            $table->integer('enfermedad_permanente')->nullable()->default(null);
            $table->string('otra_enfermedad', 191)->nullable()->default(null);
            $table->integer('medicamentos')->nullable()->default(null);
            $table->string('otros_medicamentos', 191)->nullable()->default(null);
            $table->integer('tipo_sangre')->nullable()->default(null);
            $table->integer('condicion_discapacidad')->nullable()->default(null);
            $table->integer('afiliacion_salud')->nullable()->default(null);
            $table->unsignedInteger('tipoafiliacion_id')->nullable()->default(null);
            $table->unsignedInteger('eps_id')->nullable()->default(null);
            $table->integer('libreta_militar')->nullable()->default(null);
            $table->string('no_libreta', 191)->nullable()->default(null);
            $table->string('distrito_militar', 191)->nullable()->default(null);
            $table->string('skype_empleado', 191)->nullable()->default(null);
            $table->text('proyecto_profesional')->nullable()->default(null);
            $table->string('otro_poblacional', 50)->nullable()->default(null);

            $table->index(["escolaridad_id"], 'tbl_cm_empleado_escolaridad_id_foreign');

            $table->index(["id_usuario"], 'tbl_cm_empleado_id_usuario_foreign');

            $table->index(["id_persona"], 'tbl_cm_empleado_id_persona_foreign');
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
