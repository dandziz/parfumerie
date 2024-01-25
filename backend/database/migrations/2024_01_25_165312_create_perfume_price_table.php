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
        Schema::create('perfume_price', function (Blueprint $table) {
            $table->unsignedBigInteger("perfume_id");
            $table->integer("capacity");
            $table->tinyInteger("quantity")->default(0);
            $table->unsignedDecimal("import_price");
            $table->unsignedDecimal("price");
            $table->primary(['perfume_id', 'capacity']);
            $table->foreign("perfume_id")->references("id")->on("perfumes");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfume_price');
    }
};
