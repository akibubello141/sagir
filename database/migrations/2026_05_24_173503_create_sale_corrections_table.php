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
        Schema::create('sale_corrections', function (Blueprint $table) {
             $table->id();

            $table->foreignId('sale_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('cashier_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->text('reason');

            $table->enum('status', [
                'pending',
                'approved',
                'rejected'
            ])->default('pending');

             $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_corrections');
    }
};
