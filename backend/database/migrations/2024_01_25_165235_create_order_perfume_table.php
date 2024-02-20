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
        Schema::create('order_perfume', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("order_id");
            $table->unsignedBigInteger("perfume_id");
            $table->unsignedBigInteger("capacity_id");
            $table->unsignedInteger("price");
            $table->integer("quantity");
            $table->unsignedDecimal("discount", 12);
            $table->unsignedDecimal("total", 12);
            $table->unsignedBigInteger("voucher_id")->nullable();
            $table->unique(['order_id', 'perfume_id', 'capacity_id']);
            $table->foreign("order_id")->references("id")->on("orders");
            $table->foreign("perfume_id")->references("id")->on("perfumes");
            $table->foreign("voucher_id")->references("id")->on("vouchers");
            $table->foreign("capacity_id")->references("id")->on("perfume_price");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_perfume');
    }
};
