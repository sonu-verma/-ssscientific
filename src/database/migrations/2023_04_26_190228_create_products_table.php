<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_category');
            $table->string('sku');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('short_description');
            $table->text('description');
            $table->text('features');
            $table->integer('status');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_reusable')->default(false);
//            $table->foreign('id_category')->references('id')->on('categories');
//            $table->foreign('id_vendor')->references('id')->on('vendors');
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
        Schema::dropIfExists('products');
    }
};
