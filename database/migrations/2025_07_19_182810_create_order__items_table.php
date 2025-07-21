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
        Schema::create('order__items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // links to orders
            $table->string('item_name');         // e.g., "Shirt", "Suit"
            $table->integer('quantity');         // how many
            $table->decimal('unit_price', 10, 2); // price per item
            $table->decimal('total_price', 10, 2); // quantity * unit_price
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order__items');
    }
};
