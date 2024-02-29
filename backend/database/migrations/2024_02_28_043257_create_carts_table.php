<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('unit_price');
            $table->unsignedInteger('quantity');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('perfume_id');
            $table->unsignedBigInteger('price_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('perfume_id')->references('id')->on('perfumes');
            $table->foreign('price_id')->references('id')->on('perfume_price');
            $table->unique(['user_id', 'perfume_id', 'price_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
