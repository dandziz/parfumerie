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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string("voucher")->unique();
            $table->date("start_date");
            $table->date("end_date");
            $table->integer("number_of_uses");
            $table->integer("number_of_turns_used");
            $table->integer("discount");
            $table->unsignedBigInteger("perfume_id");
            $table->foreign("perfume_id")->references("id")->on("perfumes");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
