<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota', function (Blueprint $table) {
            $table->id();
            $table->string('kode_anggota', 20)->unique();
            $table->string('nama', 100);
            $table->string('nis_nip', 20)->unique();
            $table->enum('jenis_anggota', ['siswa', 'guru']);
            $table->string('kelas', 10)->nullable(); // diisi siswa, null untuk guru
            $table->text('qr_code')->nullable();     // menyimpan string data QR
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anggota');
    }
}
