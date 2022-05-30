<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER triggerulasan AFTER INSERT ON `response` FOR EACH ROW
            BEGIN
            DECLARE iduser INT;
            DECLARE idreview INT;
  
                SELECT product_reviews.id_user, response.id_review INTO iduser, idreview FROM product_reviews JOIN response WHERE product_reviews.id = response.id_review ORDER BY response.id_review DESC LIMIT 1;

                INSERT INTO notifications (`id_ulasan_checkout`, `id_user`, `jenis`, `read`, `pesan`)
                VALUES (idreview, iduser, "ulasan", "belum", null);
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `triggerulasan`');
    }
};
