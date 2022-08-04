<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('charges')){
        Schema::create('charges', function (Blueprint $table) {

            $table->id();
            $table->integer('poulailler_id');
            $table->integer('poulailler_stock_id');
            $table->string('charge_name');
            $table->integer('price');
            $table->string('details');
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
        Schema::dropIfExists('charges');
    }
}
