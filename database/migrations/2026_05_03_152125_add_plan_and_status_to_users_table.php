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
            $table->string('plan')->default('starter')->after('email');
            $table->boolean('is_active')->default(true)->after('plan');
            $table->integer('order_limit')->default(10)->after('is_active');
        });

        Schema::table('registration_tokens', function (Blueprint $table) {
            $table->string('type')->default('starter')->after('token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['plan', 'is_active', 'order_limit']);
        });

        Schema::table('registration_tokens', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
