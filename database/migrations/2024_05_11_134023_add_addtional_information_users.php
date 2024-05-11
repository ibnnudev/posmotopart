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
        Schema::table('users', function (Blueprint $table) {
            $table->string('province')->nullable();
            $table->string('regency')->nullable();
            $table->string('district')->nullable();
            $table->string('zip_code')->nullable();
            $table->text('address')->nullable();
            $table->integer('nik')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('province');
            $table->dropColumn('regency');
            $table->dropColumn('district');
            $table->dropColumn('zip_code');
            $table->dropColumn('address');
            $table->dropColumn('nik');
        });
    }
};
