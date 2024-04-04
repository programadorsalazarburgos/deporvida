<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleUserTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'role_user';

    /**
     * Run the migrations.
     * @table role_user
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('role_id');

            $table->index(["user_id"], 'role_user_user_id_foreign');

            $table->index(["role_id"], 'role_user_role_id_foreign');
            $table->nullableTimestamps();


            $table->foreign('role_id', 'role_user_role_id_foreign')
                ->references('id')->on('roles')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('user_id', 'role_user_user_id_foreign')
                ->references('id')->on('users')
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
