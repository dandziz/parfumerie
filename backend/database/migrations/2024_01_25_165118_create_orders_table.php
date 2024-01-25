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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100);
            $table->string('email', 30)->nullable();
            $table->string('name', 50);
            $table->string('phone_number', 15);
            $table->string('address', 200);
            $table->string('province', 200);
            $table->string('district', 200);
            $table->string('ward', 200);
            $table->text('note');
            $table->unsignedBigInteger('payment_id')->unsigned();
            $table->unsignedDecimal('delivery_charge')->default(0);
            $table->tinyInteger('order_status')->default(0);
            $table->tinyInteger('payment_status')->default(0);
            $table->tinyInteger('delivery_status')->default(0);
            $table->timestamp('order_date');
            $table->dateTime('completion_date')->nullable();
            $table->dateTime('cancellation_date')->nullable();
            $table->unsignedDecimal('promotion');
            $table->unsignedDecimal('total');
            $table->tinyInteger('other')->default(0);
            $table->string('other_name', 50)->nullable();
            $table->string('other_phone', 15)->nullable();
            $table->string('other_address', 200)->nullable();
            $table->string('other_province', 200)->nullable();
            $table->string('other_district', 200)->nullable();
            $table->string('other_ward', 200)->nullable();
            $table->text('other_note')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->tinyInteger('notice')->default(0);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('manager_id')->references('id')->on('users');
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
