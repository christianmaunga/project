<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAddedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('product_added')){
        Schema::create('product_added', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('stock_id');
            $table->integer('price');
            $table->integer('number');
            $table->integer('remaining');
            $table->integer('prixtotal');
            $table->string('dateExpiration');
            $table->string('mesure');
            $table->string('quantity');
            $table->string('comment');
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
        Schema::dropIfExists('product_added');
    }
}
