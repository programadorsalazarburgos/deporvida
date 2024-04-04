<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblCmFichaTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tbl_cm_ficha';

    /**
     * Run the migrations.
     * @table tbl_cm_ficha
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('id_persona_beneficiario')->nullable()->default(null);
            $table->unsignedInteger('grupo_id')->nullable()->default(null);
            $table->date('fecha_inscripcion')->nullable()->default(null);
            $table->string('no_ficha', 191)->nullable()->default(null);
            $table->unsignedInteger('modalidad_id')->nullable()->default(null);
            $table->unsignedInteger('puntoatencion_id')->nullable()->default(null);
            $table->integer('hijos_beneficiario')->nullable()->default(null);
            $table->integer('cantidad_hijos_beneficiario')->nullable()->default(null);
            $table->integer('ocupacion_beneficiario')->nullable()->default(null);
            $table->unsignedInteger('escolaridad_id')->nullable()->default(null);
            $table->integer('estado_escolaridad')->nullable()->default(null);
            $table->integer('cultura_beneficiario')->nullable()->default(null);
            $table->integer('discapacidad_beneficiario')->nullable()->default(null);
            $table->unsignedInteger('discapacidad_id')->nullable()->default(null);
            $table->string('otra_discapacidad_beneficiario', 191)->nullable()->default(null);
            $table->integer('medicamentos_permanente_beneficiario')->nullable()->default(null);
            $table->string('medicamentos_beneficiario', 191)->nullable()->default(null);
            $table->integer('condicion_discapacidad')->nullable()->default(null);
            $table->integer('afiliacion_salud')->nullable()->default(null);
            $table->integer('tipo_afiliacion')->nullable()->default(null);
            $table->unsignedInteger('salud_sgss_id')->nullable()->default(null);
            $table->unsignedInteger('id_persona_acudiente')->nullable()->default(null);
            $table->string('parentesco_acudiente', 191)->nullable()->default(null);
            $table->string('otro_parentesco_acudiente', 191)->nullable()->default(null);
            $table->date('fecha_retiro')->nullable()->default(null);
            $table->string('otro_poblacional', 50)->nullable()->default(null);
            $table->string('tenantId', 20)->nullable()->default(null);

            $table->index(["escolaridad_id"], 'tbl_cm_ficha_escolaridad_id_foreign');

            $table->index(["modalidad_id"], 'tbl_cm_ficha_modalidad_id_foreign');

            $table->index(["id_persona_beneficiario"], 'tbl_cm_ficha_id_persona_beneficiario_foreign');

            $table->index(["puntoatencion_id"], 'tbl_cm_ficha_puntoatencion_id_foreign');

            $table->index(["id_persona_acudiente"], 'tbl_cm_ficha_id_persona_acudiente_foreign');

            $table->index(["discapacidad_id"], 'tbl_cm_ficha_discapacidad_id_foreign');

            $table->index(["salud_sgss_id"], 'tbl_cm_ficha_salud_sgss_id_foreign');

            $table->index(["grupo_id"], 'tbl_cm_ficha_grupo_id_foreign');
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
