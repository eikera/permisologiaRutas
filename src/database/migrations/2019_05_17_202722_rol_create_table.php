<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RolCreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rol', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion');
            $table->timestamps();
        });
        /*DB::table('rol')->insert(
            array(
                array(
                    'descripcion' => 'administrador',
                ),
                array(
                    'descripcion' => 'presentador',
                ),
                array(
                    'descripcion' => 'gerente',
                ),
                array(
                    'descripcion' => 'recepcion',
                ),
            )
        );*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rol');
    }
}
