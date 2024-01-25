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
            $table->unsignedBigInteger("order_id");
            $table->unsignedBigInteger("perfume_id");
            $table->integer("capacity");
            $table->unsignedDecimal("price");
            $table->integer("quantity");
            $table->unsignedDecimal("discount");
            $table->unsignedDecimal("total");
            $table->unsignedBigInteger("voucher_id")->nullable();
            $table->primary(['order_id', 'perfume_id', 'capacity']);
            $table->foreign("order_id")->references("id")->on("orders");
            $table->foreign("perfume_id")->references("id")->on("perfumes");
            $table->foreign("voucher_id")->references("id")->on("vouchers");
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
