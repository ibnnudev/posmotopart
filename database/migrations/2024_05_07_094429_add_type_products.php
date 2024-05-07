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
        Schema::table('products', function (Blueprint $table) {
            $table->string('type')->nullable()->after('name');
            $table->string('machine_name')->nullable()->after('type');
            $table->string('SAE')->nullable()->after('machine_name');
            $table->string('manufacturer')->nullable()->after('SAE');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('machine_name');
            $table->dropColumn('SAE');
            $table->dropColumn('manufacturer');
        });
    }
};
