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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the item
            $table->integer('stock')->default(0); // Current stock
            $table->integer('min_stock')->default(0); // Minimum threshold for alert
            $table->decimal('unit_price', 10, 2); // Price per unit
            $table->string('unit'); // e.g., kg, piece
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
