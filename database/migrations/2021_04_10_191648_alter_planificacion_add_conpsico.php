<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPlanificacionAddConpsico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_dv_grupos_horario_planificacion', function (Blueprint $table) {
			$table->text('cont_psicosocial')->nullable()->after('tema');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('tbl_dv_grupos_horario_planificacion', function($table) {
			$table->dropColumn('cont_psicosocial');
		});
    }
}
