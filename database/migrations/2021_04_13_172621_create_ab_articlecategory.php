<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbArticlecategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ab_articlecategory', function (Blueprint $table) {
            $table->id();
            $table->string('ab_name',100)->nullable(false)->unique();
            $table->string('ab_description',1000)->nullable(true);
            $table->foreignId('ab_parent')->nullable(true)->references('id')->on('ab_articlecategory');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ab_articlecategory');
    }
}
