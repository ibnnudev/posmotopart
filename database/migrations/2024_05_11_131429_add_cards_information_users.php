<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // card information
            $table->string('card_number')->nullable(); // example: 1234567890
            $table->string('bank_name')->nullable(); // example: BCA, BNI, BRI, Mandiri
            $table->string('owner_name')->nullable(); // example: John Doe
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['card_number', 'bank_name', 'owner_name']);
        });
    }
};
