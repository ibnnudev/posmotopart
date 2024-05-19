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
            $table->text('transaction_code')->after('id');
        });

        \App\Models\TransactionDetail::all()->each(function ($transactionDetail) {
            $transactionDetail->transaction_code = 'TRX' . date('Ym') . '-' . sprintf('%04d', \App\Models\TransactionDetail::count() + 1);
            $transactionDetail->save();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaction_details', function (Blueprint $table) {
            $table->dropColumn('transaction_code');
        });
    }
};
