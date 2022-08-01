<?php

use Brick\Math\BigInteger;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBokingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boking', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_customer');
            $table->integer('id_lapangan');
            $table->string('jenis_lapangan',15);
            $table->string('lama_sewa');
            $table->float('total_bayar',10);
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
        Schema::dropIfExists('boking');
    }
}
