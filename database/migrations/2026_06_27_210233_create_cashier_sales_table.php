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
        Schema::create('cashier_sales', function (Blueprint $table) {
            $table->id();

            $table->foreignId('customer_id')->constrained('users');
            
            $table->foreignId('product_id')->constrained('users');

            $table->integer('bags_sold')->default(0);

            $table->decimal('total_amount', 15, 2)->default(0);
    
            $table->integer('linkages')->default(0);
            $table->decimal('linkage_amount', 15, 2)->default(0);

            $table->integer('plus')->default(0);
            $table->decimal('plus_amount', 15, 2)->default(0);

            $table->decimal('vehicle_fuel', 15, 2)->default(0);
            $table->decimal('vehicle_exp', 15, 2)->default(0);

            $table->decimal('credit', 15, 2)->default(0);
            $table->decimal('transfer', 15, 2)->default(0);
            $table->decimal('paid_credit', 15, 2)->default(0);

            $table->decimal('special_exp1', 15, 2)->default(0);
            $table->decimal('special_exp2', 15, 2)->default(0);

            $table->decimal('gross', 15, 2)->default(0);
            $table->decimal('total_balance', 15, 2)->default(0);

            $table->foreignId('cashier_id')->constrained('users');

            $table->date('sales_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cashier_sales');
    }
};
