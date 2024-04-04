<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblDvFichaTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tbl_dv_ficha';

    /**
     * Run the migrations.
     * @table tbl_dv_ficha
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->date('fecha_registro')->nullable()->default(null);
            $table->integer('id_persona_beneficiario')->nullable()->default(null);
            $table->integer('id_escolaridad_nivel')->nullable()->default(null);
            $table->integer('id_escolaridad_estado')->nullable()->default(null);
            $table->integer('id_etnia')->nullable()->default(null);
            $table->integer('id_persona_acudiente')->nullable()->default(null);
            $table->integer('id_persona_acudiente_parentesco')->nullable()->default(null);
            $table->integer('id_persona_vive_con_parentesco')->nullable()->default(null);
            $table->enum('enfermedad_padece_si', ['si', 'no'])->nullable()->default(null);
            $table->string('enfermedad_padece_nombre', 200)->nullable()->default(null);
            $table->enum('medicamentos_toma_si', ['si', 'no'])->nullable()->default(null);
            $table->string('medicamentos_toma_nombre')->nullable()->default(null);
            $table->enum('salud_afiliado', ['si', 'no'])->nullable()->default(null);
            $table->integer('id_salud_regimen')->nullable()->default(null);
            $table->integer('id_eps')->nullable()->default(null);
            $table->integer('id_grupo')->nullable()->default(null);
            $table->date('fecha_retiro')->nullable()->default(null)->comment('Campo nuevo, agregar al modelo');
            $table->string('grupo_poblacional_otro', 200)->nullable()->default(null);
            $table->integer('participacion_anterior_meses')->nullable()->default(null);
            $table->integer('participacion_anterior_annos')->nullable()->default(null);
            $table->string('persona_vive_con_parentesco_otro', 200)->nullable()->default(null);
            $table->string('persona_acudiente_parentesco_otro', 200)->nullable()->default(null);
            $table->string('se_reconoce_como_cual', 200)->nullable()->default(null);
            $table->integer('id_ocupacion')->nullable()->default(null);
            $table->integer('tiene_discapacidad')->nullable()->default('0')->comment('0=no
1=si');
            $table->integer('toma_medicamentos')->nullable()->default(null);
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
