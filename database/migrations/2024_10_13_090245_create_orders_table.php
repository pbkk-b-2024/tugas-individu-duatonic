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
            $table->char('order_id', 6)->primary();
            $table->foreignId('user_id')->constrained('users', 'id')->onDelete('cascade');
            $table->string('order_status')->default('Awaiting Payment');
            $table->decimal('order_total', 10, 2);
            $table->char('payment_id', 6)->constrained('payment_method', 'pay_id')->onDelete('cascade');
            $table->string('order_address');
            $table->timestamps();
        });

        Schema::create('order_detail', function (Blueprint $table) {
            $table->char('od_id', 6)->primary();
            $table->char('order_id', 6)->constrained('orders', 'order_id')->onDelete('cascade');  // Links to orders
            $table->char('item_id', 6)->constrained('items', 'item_id')->onDelete('cascade');  // Links to items
            $table->integer('od_quantity');  // Quantity of this item in the order
            $table->decimal('od_price', 10, 2);  // Price of the item at the time of the order
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_detail');
    }
};
