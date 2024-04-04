<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGruposTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'grupos';

    /**
     * Run the migrations.
     * @table grupos
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('codigo_grupo', 10);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('sede_id');
            $table->string('observaciones', 191)->nullable()->default('');
            $table->unsignedInteger('programa_id')->nullable()->default(null);
            $table->unsignedInteger('grado_id');
            $table->tinyInteger('estado');
            $table->string('tenantId', 20)->nullable()->default(null);

            $table->index(["programa_id"], 'grupos_programa_id_foreign');

            $table->index(["user_id"], 'grupos_user_id_foreign');

            $table->index(["sede_id"], 'grupos_sede_id_foreign');
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
