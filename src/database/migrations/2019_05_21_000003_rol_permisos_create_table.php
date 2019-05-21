<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RolPermisosCreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('rol_permisos')){
            Schema::create('rol_permisos', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->integer('permisos_id')->unsigned();
                $table->integer('rol_id')->unsigned();
                $table->rememberToken();
                $table->timestamps();
                $table->foreign('permisos_id')->references('id')->on('permisos');
                $table->foreign('rol_id')->references('id')->on('rol');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rol_permisos');
    }
}
