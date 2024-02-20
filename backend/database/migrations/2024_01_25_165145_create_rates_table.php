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
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('perfume_id');
            $table->string('name', 100);
            $table->string('phone_number', 100);
            $table->string('email', 100)->nullable();
            $table->string('content', 100);
            $table->tinyInteger('rate');
            $table->unique(['order_id', 'perfume_id']);
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('perfume_id')->references('id')->on('perfumes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rates');
    }
};
