<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbShoppingcartItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ab_shoppingcart_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ab_shoppingcart_id')->nullable(false)->references('id')->on('ab_shoppingcart')->cascadeOnDelete();
            $table->foreignId('ab_article_id')->nullable(false)->references('id')->on('ab_article');
            $table->timestamp('ab_createdate')->nullable(false);
            $table->unique(['ab_article_id','ab_shoppingcart_id']);

	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ab_shoppingcart_item');
    }
}
