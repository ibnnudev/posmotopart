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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('product_id')->constrained()->cascadeOnDelete();
            $table->integer('qty');
            $table->decimal('price', 15, 2);
            $table->decimal('total_price', 15, 2);
            $table->decimal('admin_fee', 15, 2);
            $table->enum('status', [
                'waiting_payment',
                'user_confirm',
                'admin_confirm',
                'admin_reject',
                'user_reject',
                'process_by_merchant',
                'shipping',
                'done',
                'waiting_confirmation'
            ]);
            $table->date('shipping_date')->nullable();
            $table->foreignId('payment_option_id')->constrained('payment_options')->cascadeOnDelete();
            $table->string('payment_proof')->nullable();
            $table->date('confirm_date')->nullable();
            $table->date('receive_date')->nullable();
            $table->string('receive_proof')->nullable();
            $table->string('receive_by')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
