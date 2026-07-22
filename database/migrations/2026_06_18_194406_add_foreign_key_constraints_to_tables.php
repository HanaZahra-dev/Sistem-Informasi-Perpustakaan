<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyConstraintsToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // ── RAK ──
        Schema::table('rak', function (Blueprint $table) {
            $table->foreign('kategori_id')
                  ->references('id')->on('kategori')
                  ->onDelete('cascade');
        });

        // ── BUKU ──
        Schema::table('buku', function (Blueprint $table) {
            $table->foreign('penerbit_id')
                  ->references('id')->on('penerbit')
                  ->onDelete('cascade');

            $table->foreign('kategori_id')
                  ->references('id')->on('kategori')
                  ->onDelete('cascade');

            $table->foreign('rak_id')
                  ->references('id')->on('rak')
                  ->onDelete('cascade');
        });

        // ── PEMINJAMAN ──
        Schema::table('peminjaman', function (Blueprint $table) {

            $table->foreign('petugas_pinjam')
                  ->references('id')->on('users')
                  ->onDelete('set null');

            $table->foreign('petugas_kembali')
                  ->references('id')->on('users')
                  ->onDelete('set null');
        });

        // ── DETAIL_PEMINJAMAN ──
        Schema::table('detail_peminjaman', function (Blueprint $table) {
            $table->foreign('peminjaman_id')
                  ->references('id')->on('peminjaman')
                  ->onDelete('cascade');

            $table->foreign('buku_id')
                  ->references('id')->on('buku')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    
        Schema::table('buku', function (Blueprint $table) {
            $table->dropForeign(['penerbit_id']);
            $table->dropForeign(['kategori_id']);
            $table->dropForeign(['rak_id']);
        });

        Schema::table('rak', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
        });
    }
}
