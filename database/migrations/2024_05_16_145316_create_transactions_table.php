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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('product_id')->constrained()->cascadeOnDelete();
            $table->integer('requested_qty')->nullable();
            $table->integer('rejected_qty')->nullable();
            $table->integer('approved_qty')->nullable();
            $table->decimal('discount_price', 15, 2)->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->decimal('total_price', 15, 2)->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
