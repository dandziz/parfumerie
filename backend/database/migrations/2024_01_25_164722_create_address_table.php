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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('phone_number', 15);
            $table->string('company', 100);
            $table->string('address', 200);
            $table->string('province', 50);
            $table->string('district', 50);
            $table->string('ward', 50);
            $table->unsignedInteger('province_id');
            $table->unsignedInteger('district_id');
            $table->unsignedInteger('ward_id');
            $table->string('zip_code', 10);
            $table->tinyInteger('default');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
