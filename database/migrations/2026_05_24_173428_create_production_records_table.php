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
        Schema::create('production_records', function (Blueprint $table) {
             $table->id();

            $table->string('producer_name')->nullable();

            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');

            $table->integer('quantity_produced');

            $table->integer('damaged_quantity')->default(0);

            $table->integer('returned_quantity')->default(0);

            $table->enum('shifting', [
                'morning',
                'afternoon',
             ]);

            $table->foreignId('supervisor_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->date('production_date')->default(now());

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_records');
    }
};
