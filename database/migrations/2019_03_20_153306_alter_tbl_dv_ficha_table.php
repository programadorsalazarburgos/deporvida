<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTblDvFichaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_dv_ficha', function (Blueprint $table) {
             $table->unsignedInteger('id_motivo')->nullable();
             $table->foreign('id_motivo')->references('id')->on('tbl_motivos_desvinculaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_dv_ficha', function (Blueprint $table) {
            //
        });
    }
}
