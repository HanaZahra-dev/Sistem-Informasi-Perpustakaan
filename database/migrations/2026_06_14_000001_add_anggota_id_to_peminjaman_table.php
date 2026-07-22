<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAnggotaIdToPeminjamanTable extends Migration
{
    public function up()
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->unsignedBigInteger('anggota_id')
                  ->nullable()
                  ->after('peminjam_id')
                  ->comment('FK ke tabel anggota; diisi saat pinjam via alur tanpa login');

            $table->foreign('anggota_id')
                  ->references('id')
                  ->on('anggota')
                  ->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dropForeign(['anggota_id']);
            $table->dropColumn('anggota_id');
        });
    }
}