<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PermisosCreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('permisos')){
            Schema::create('permisos', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->string('nombre','64')->unique();
                $table->text('descripcion');
                $table->string('type','5');
                $table->string('url','150');
                $table->string('controller','150');
                $table->rememberToken();
                $table->timestamps();
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
        Schema::drop('permisos');
    }
}
