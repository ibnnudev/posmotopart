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
        Schema::table('transaction_details', function (Blueprint $table) {
            $table->dropForeign(['transaction_id']);
            $table->dropColumn('transaction_id');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->text('transaction_code')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaction_details', function (Blueprint $table) {
            $table->foreignId('transaction_id')->constrained('transactions')->onDelete('cascade');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('transaction_code');
        });
    }
};
