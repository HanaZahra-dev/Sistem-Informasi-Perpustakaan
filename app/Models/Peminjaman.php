<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Anggota;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $fillable = [
        'kode_pinjam', 'peminjam_id', 'anggota_id', 'petugas_pinjam', 'petugas_kembali',
        'status', 'denda', 'alasan_tolak',
        'tanggal_pinjam', 'tanggal_kembali', 'tanggal_pengembalian'
    ];

    public function detail_peminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'peminjam_id');
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    public function getDendaAttribute($value)
    {
        return $value ? "Rp. {$value}" : '-';
    }

    public function getTanggalPinjamAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-M-Y') : '-';
    }

    public function getTanggalKembaliAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-M-Y') : '-';
    }

    public function getTanggalPengembalianAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-M-Y') : '-';
    }
}