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
        Schema::create('estates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('location_id')->index();
            $table->foreign('location_id')->references('id')->on('locations')->cascadeOnDelete();
            $table->unsignedBigInteger('category_id')->index();
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->unsignedBigInteger('price')->default(0);
            $table->string('name');
            $table->string('phone');
            $table->string('slug')->index();
            $table->string('description')->nullable();
            $table->boolean('credit')->default(0);
            $table->boolean('swap')->default(0);
            $table->boolean('yard')->default(0);
            $table->boolean('lift')->default(0);
            $table->boolean('balcony')->default(0);
            $table->unsignedInteger('viewed')->default(0);
            $table->unsignedInteger('favorited')->default(0);
            $table->unsignedInteger('random')->default(0);
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
        Schema::dropIfExists('estates');
    }
};
