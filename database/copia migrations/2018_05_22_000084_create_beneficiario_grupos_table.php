<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeneficiarioGruposTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'beneficiario_grupos';

    /**
     * Run the migrations.
     * @table beneficiario_grupos
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('grupo_id')->nullable()->default(null);
            $table->unsignedInteger('id_persona_beneficiario')->nullable()->default(null);
            $table->date('fecha_inscripcion');

            $table->index(["grupo_id"], 'beneficiario_grupos_grupo_id_foreign');

            $table->index(["id_persona_beneficiario"], 'beneficiario_grupos_id_persona_beneficiario_foreign');
            $table->nullableTimestamps();


            $table->foreign('grupo_id', 'beneficiario_grupos_grupo_id_foreign')
                ->references('id')->on('grupos')
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
