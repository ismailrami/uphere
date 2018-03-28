<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {

            $table->increments('id');
            $table->float('latitude');
            $table->float('longitude');
            $table->string('adresse');
            $table->string('message');
            $table->integer('user_id')->unsigned();
            
            $table->timestamps();

        });

       
    }

    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
