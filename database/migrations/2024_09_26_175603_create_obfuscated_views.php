<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateObfuscatedViews extends Migration
{
    public function up()
    {
        // Create views with obfuscated names
        DB::statement('CREATE VIEW sg1x3z AS SELECT * FROM slider');
        DB::statement('CREATE VIEW lk2y4w AS SELECT * FROM links');
        DB::statement('CREATE VIEW nu3v5r AS SELECT * FROM news_and_update_banners');
        DB::statement('CREATE VIEW nu4y6t AS SELECT * FROM news_updates');
        DB::statement('CREATE VIEW pn5z7q AS SELECT * FROM public_notes');
        DB::statement('CREATE VIEW nu6w8e AS SELECT * FROM news_and_update_banners'); // Duplicate table, using the same name again
        DB::statement('CREATE VIEW td7y9r AS SELECT * FROM tenders');
        DB::statement('CREATE VIEW tb8z1s AS SELECT * FROM tender_banners');
        DB::statement('CREATE VIEW bm9x2d AS SELECT * FROM board_meeting_banners');
        DB::statement('CREATE VIEW bm0y3f AS SELECT * FROM board_meetings');
    }

    public function down()
    {
        // Drop the views
        DB::statement('DROP VIEW IF EXISTS sg1x3z');
        DB::statement('DROP VIEW IF EXISTS lk2y4w');
        DB::statement('DROP VIEW IF EXISTS nu3v5r');
        DB::statement('DROP VIEW IF EXISTS nu4y6t');
        DB::statement('DROP VIEW IF EXISTS pn5z7q');
        DB::statement('DROP VIEW IF EXISTS nu6w8e'); // Duplicate table, using the same name again
        DB::statement('DROP VIEW IF EXISTS td7y9r');
        DB::statement('DROP VIEW IF EXISTS tb8z1s');
        DB::statement('DROP VIEW IF EXISTS bm9x2d');
        DB::statement('DROP VIEW IF EXISTS bm0y3f');
    }
}
