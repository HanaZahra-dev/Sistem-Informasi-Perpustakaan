<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';

    protected $fillable = [
        'kode_anggota',
        'nama',
        'nis_nip',
        'jenis_anggota',
        'kelas',
        'qr_code',
    ];

    /**
     * Generate kode anggota otomatis.
     * Format: AGT-YYYY-XXXXX (contoh: AGT-2025-00001)
     */
    public static function generateKodeAnggota(): string
    {
        $tahun  = date('Y');
        $prefix = "AGT-{$tahun}-";

        $last = self::where('kode_anggota', 'like', "{$prefix}%")
            ->orderByDesc('id')
            ->value('kode_anggota');

        $urutan = $last
            ? (int) substr($last, strlen($prefix)) + 1
            : 1;

        return $prefix . str_pad($urutan, 5, '0', STR_PAD_LEFT);
    }

    /**
     * Label jenis anggota yang ramah.
     */
    public function getLabelJenisAttribute(): string
    {
        return match ($this->jenis_anggota) {
            'guru'  => 'Guru',
            'siswa' => "Siswa Kelas {$this->kelas}",
            default => $this->jenis_anggota,
        };
    }
}
