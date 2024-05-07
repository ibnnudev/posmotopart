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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->foreignUuid('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('SKU')->nullable()->unique();
            $table->string('SKU_seller')->nullable();
            $table->string('name');
            $table->integer('stock');
            $table->string('size')->nullable();
            $table->string('unit')->nullable();
            $table->decimal('price', 10, 2)->default(0.00);
            $table->decimal('discount', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
