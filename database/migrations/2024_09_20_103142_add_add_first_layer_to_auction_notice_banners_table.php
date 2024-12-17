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
        Schema::table('auction_notice_banners', function (Blueprint $table) {
            $table->string('addFirstLayer')->nullable()->after('status'); // Add the new column after the 'status' column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('auction_notice_banners', function (Blueprint $table) {
            $table->dropColumn('addFirstLayer'); // Drop the column if the migration is rolled back
        });
    }
};
