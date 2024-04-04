<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblGenVeredasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tbl_gen_veredas';

    /**
     * Run the migrations.
     * @table tbl_gen_veredas
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('id_comuna')->nullable()->default(null)->comment('Cuencas');
            $table->string('nombre', 191);
            $table->string('codigo_unico', 191)->nullable()->default(null);
            $table->string('codigo_estudio', 191)->nullable()->default(null);
            $table->integer('estrato')->nullable()->default(null);
            $table->unsignedInteger('corregimiento_id');
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
