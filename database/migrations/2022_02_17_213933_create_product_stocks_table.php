<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   if(!Schema::hasTable('product_stocks')){
        
        Schema::create('product_stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('StockID');
            $table->string('nom');
            $table->string('fabricant');
            $table->integer('prix');
            $table->integer('nombre');
            $table->integer('remaing');
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
        Schema::dropIfExists('product_stocks');
    }
}
