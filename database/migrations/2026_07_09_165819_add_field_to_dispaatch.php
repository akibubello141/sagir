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
        Schema::table('dispatches', function (Blueprint $table) {
            //

         $table->string('production_site')->nullable()->after('driver_name');
         $table->string('shifting')->nullable()->after('production_site');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dispaatch', function (Blueprint $table) {
            //
             $table->dropColumn([
                'production_site',
                'shifting',
            ]);
        });
    }
};
