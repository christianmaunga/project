<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockPoulaillersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_poulaillers', function (Blueprint $table) {
            $table->id();
            $table->integer('poulailler_id_fk');
            $table->integer('number_of_chicken');
            $table->integer('prix_unitaire');
            $table->integer('poules_restantes');
            $table->integer('morts');
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
        Schema::dropIfExists('stock_poulaillers');
    }
}
