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
        Schema::table('slider', function (Blueprint $table) {
            //
            $table->string('mobile_image')->nullable()->after('image');
            $table->boolean('is_same_as_laptop_view')->default(false)->after('mobile_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('slider', function (Blueprint $table) {
            //
            $table->dropColumn('mobile_image');
            $table->dropColumn('is_same_as_laptop_view');
        });
    }
};
