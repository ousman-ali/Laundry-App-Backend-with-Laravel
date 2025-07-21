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
            $table->foreignId('customer_id')->constrained()->onDelete('cascade'); // linked to customers table
            $table->string('ticket_number')->unique(); // e.g. ORD001
            $table->enum('order_type', ['normal', 'urgent'])->default('normal');
            $table->decimal('total_price', 10, 2)->default(0);
            $table->timestamp('pickup_datetime')->nullable();
            $table->enum('status', [
                'received',
                'washing',
                'drying',
                'steaming',
                'packaging',
                'ready'
            ])->default('received');
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
