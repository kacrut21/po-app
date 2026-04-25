<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('store_name')->nullable()->after('name');
            $table->string('store_phone')->nullable()->after('store_name');
            $table->string('store_address')->nullable()->after('store_phone');
            $table->string('invoice_footer')->nullable()->after('store_address')
                  ->comment('Pesan penutup di invoice WA');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['store_name', 'store_phone', 'store_address', 'invoice_footer']);
        });
    }
};
