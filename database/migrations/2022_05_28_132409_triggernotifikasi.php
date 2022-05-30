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
        CREATE TRIGGER triggernotifikasi AFTER UPDATE ON `checkout` FOR EACH ROW
            BEGIN
                INSERT INTO notifications (`id_ulasan_checkout`, `id_user`, `jenis`, `read`, `pesan`) 
                VALUES (NEW.id, NEW.id_user, "checkout", "belum", null);
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
        DB::unprepared('DROP TRIGGER `triggernotifikasi`');
    }
};
