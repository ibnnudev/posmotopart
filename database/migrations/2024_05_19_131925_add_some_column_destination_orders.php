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
        Schema::table('destination_orders', function (Blueprint $table) {
            $table->text('district')->nullable();
            $table->text('regency')->nullable();
            $table->text('province')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('plus_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('destination_orders', function (Blueprint $table) {
            $table->dropColumn('district');
            $table->dropColumn('regency');
            $table->dropColumn('province');
            $table->dropColumn('postal_code');
            $table->dropColumn('plus_code');
        });
    }
};
