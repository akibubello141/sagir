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
        Schema::table('production_records', function (Blueprint $table) {
            //
             $table->string('production_site')->after('id');

            $table->decimal('kg_collected',10,2)->default(0)->after('product_id');

            $table->decimal('kg_used',10,2)->default(0)->after('kg_collected');

            $table->decimal('kg_left',10,2)->default(0)->after('kg_used');

            $table->integer('bags_per_kg')->default(0)->after('kg_used');
            
            $table->text('remarks')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('production_records', function (Blueprint $table) {
            //
             $table->dropColumn([
                'production_site',
                'kg_collected',
                'kg_used',
                'kg_left',
                'bags_per_kg',
                'remarks'
            ]);
        });
    }
};
