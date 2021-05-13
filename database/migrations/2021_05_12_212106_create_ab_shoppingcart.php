<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbShoppingcart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ab_shoppingcart', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ab_creator_id')->nullable(false)->references('id')->on('ab_user');
            $table->timestamp('ab_createdate')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ab_shoppingcart');
    }
}
