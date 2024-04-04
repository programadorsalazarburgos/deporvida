<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblGenContratoCuentaCobroTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tbl_gen_contrato_cuenta_cobro';

    /**
     * Run the migrations.
     * @table tbl_gen_contrato_cuenta_cobro
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('id_cuenta_cobro_estado');
            $table->date('fecha_transaccion')->nullable()->default(null);
            $table->string('planilla_numero', 20)->nullable()->default(null);
            $table->string('pin_numero', 20)->nullable()->default(null);
            $table->string('operador', 100)->nullable()->default(null);
            $table->date('fecha_pago')->nullable()->default(null);
            $table->string('periodo_pago_seguridad_social', 100)->nullable()->default(null);
            $table->text('tareas_supervisor')->nullable()->default(null);
            $table->text('tareas_informe_mensual')->nullable()->default(null);
            $table->integer('id_contrato_cuota')->nullable()->default(null);
            $table->integer('valor')->nullable()->default(null);
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
