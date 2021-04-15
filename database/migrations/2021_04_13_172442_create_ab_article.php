<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbArticle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ab_article', function (Blueprint $table) {
            $table->id();
            $table->string("ab_name",80)->nullable(false);
            $table->integer('ab_price')->nullable(false);
            $table->string('ab_description',1000)->nullable(false);
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
        Schema::dropIfExists('ab_article');
    }
}
