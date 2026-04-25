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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('order_number')->unique();
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->dateTime('order_date');
            $table->dateTime('delivery_date');
            $table->string('pickup_method');
            $table->text('delivery_address')->nullable();
            $table->integer('subtotal');
            $table->integer('shipping_fee')->default(0);
            $table->integer('total_amount');
            $table->integer('down_payment')->nullable();
            $table->string('payment_status');
            $table->string('payment_method');
            $table->string('order_status');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
