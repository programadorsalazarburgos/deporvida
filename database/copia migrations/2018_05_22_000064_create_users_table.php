<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'users';

    /**
     * Run the migrations.
     * @table users
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('primer_nombre', 191);
            $table->string('email', 191);
            $table->string('password', 191);
            $table->rememberToken();
            $table->string('segundo_nombre', 191)->nullable()->default(null);
            $table->string('primer_apellido', 191);
            $table->string('segundo_apellido', 191)->nullable()->default(null);
            $table->string('tipo_documento', 191);
            $table->string('numero_documento', 191);
            $table->string('direccion', 191)->nullable()->default(null);
            $table->date('fecha_nacimiento');
            $table->string('telefono_movil', 191)->nullable()->default(null);
            $table->string('telefono_fijo', 191)->nullable()->default(null);
            $table->string('tenantId', 20);
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
