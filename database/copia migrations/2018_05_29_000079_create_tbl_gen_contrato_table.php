<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblGenContratoTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tbl_gen_contrato';

    /**
     * Run the migrations.
     * @table tbl_gen_contrato
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('id_persona');
            $table->string('rcp', 100)->nullable()->default(null);
            $table->string('dcp', 100)->nullable()->default(null);
            $table->string('contrato_numero', 100)->nullable()->default(null);
            $table->double('contrato_valor')->nullable()->default(null);
            $table->text('contrato_objeto')->nullable()->default(null);
            $table->integer('cuotas')->nullable()->default(null);
            $table->date('fecha_inicio')->nullable()->default(null);
            $table->date('fecha_terminacion')->nullable()->default(null);
            $table->string('tenantId', 50)->nullable()->default(null);
            $table->integer('activo')->nullable()->default('1');

            $table->index(["id_persona"], 'tbl_gen_contrato_fk1');
            $table->nullableTimestamps();


            $table->foreign('id_persona', 'tbl_gen_contrato_fk1')
                ->references('id')->on('tbl_gen_persona')
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
