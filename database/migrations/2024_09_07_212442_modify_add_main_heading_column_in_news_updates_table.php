<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyAddMainHeadingColumnInNewsUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news_updates', function (Blueprint $table) {
            $table->string('add_main_heading')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news_updates', function (Blueprint $table) {
            $table->string('add_main_heading')->nullable(false)->change();
        });
    }
}
