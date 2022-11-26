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
        Schema::create('estate_values', function (Blueprint $table) {
            $table->unsignedBigInteger('estate_id')->index();
            $table->foreign('estate_id')->references('id')->on('estates')->cascadeOnDelete();
            $table->unsignedBigInteger('value_id')->index();
            $table->foreign('value_id')->references('id')->on('values')->cascadeOnDelete();
            $table->primary(['estate_id', 'value_id']);
            $table->unsignedInteger('sort_order')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estate_values');
    }
};
