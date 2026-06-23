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
         Schema::create('sales', function (Blueprint $table) {

            $table->id();

            $table->foreignId('cashier_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->foreignId('customer_id')
                ->nullable()
                ->constrained('customers')
                ->onDelete('set null');

            $table->decimal('total_amount', 10, 2);

            $table->enum('payment_method', [
                'cash',
                'transfer',
                'pos',
                'credit',
             ]);

            $table->decimal('part_payment', 10, 2)->default(0);

             

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
