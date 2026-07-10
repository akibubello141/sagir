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
        Schema::create('dispatches', function (Blueprint $table) {
                        $table->id();

            // Product
            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            // Supervisor
            $table->foreignId('supervisor_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Dispatch Details
            $table->string('vehicle')->nullable();
            $table->string('driver_name')->nullable();

            $table->date('dispatch_date');

            // Quantities
            $table->integer('quantity_made')->default(0);
            $table->integer('quantity_produced')->default(0);
            $table->integer('quantity_dispatched')->default(0);
            $table->integer('linkage')->default(0);
            $table->integer('refill')->default(0);
            $table->integer('quantity_left')->default(0);

            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispatches');
    }
};
