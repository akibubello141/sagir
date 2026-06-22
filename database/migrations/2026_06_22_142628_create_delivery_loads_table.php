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
        Schema::create('delivery_loads', function (Blueprint $table) {
           $table->id();

                $table->foreignId('driver_id')
                    ->constrained()
                    ->cascadeOnDelete();

                $table->foreignId('supervisor_id')
                    ->constrained('users')
                    ->cascadeOnDelete();

                $table->date('delivery_date');

                $table->enum('status', [
                    'pending',
                    'completed'
                ])->default('pending');

                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_loads');
    }
};
