<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblGenContratoCuotaTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tbl_gen_contrato_cuota';

    /**
     * Run the migrations.
     * @table tbl_gen_contrato_cuota
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('id_contrato');
            $table->double('valor_saldo')->nullable()->default(null);
            $table->double('valor_cuota')->nullable()->default(null);
            $table->enum('estado', ['pago', 'rechazado', 'pendiente'])->nullable()->default(null);
            $table->date('fecha_generacion')->nullable()->default(null);
            $table->integer('cuota_numero')->nullable()->default(null);
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
