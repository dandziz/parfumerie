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
            $table->id();
            $table->unsignedBigInteger("perfume_id");
            $table->string("capacity");
            $table->tinyInteger("quantity")->default(0);
            $table->unsignedInteger("import_price");
            $table->unsignedInteger("price");
            $table->unique(['perfume_id', 'capacity']);
            $table->foreign("perfume_id")->references("id")->on("perfumes");
            $table->timestamps();
            $table->softDeletes();
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
