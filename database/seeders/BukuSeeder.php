<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Buku::create([
            'judul' => 'bintang',
            'slug' => Str::slug('bintang'),
            'sampul' => 'buku/Sampul_novel_Bintang.jpeg',
            'penulis' => 'tere liye',
            'penerbit_id' => 2,
            'kategori_id' => 2,
            'rak_id' => 2,
            'stok' => 10
        ]);

        Buku::create([
            'judul' => 'matahari',
            'slug' => Str::slug('matahari'),
            'sampul' => 'buku/matahari.png',
            'penulis' => 'tere liye',
            'penerbit_id' => 3,
            'kategori_id' => 2,
            'rak_id' => 3,
            'stok' => 10
        ]);

        Buku::create([
            'judul' => 'tentang kamu',
            'slug' => Str::slug('tentang-kamu'),
            'sampul' => 'buku/tentang_kamu.png',
            'penulis' => 'tere liye',
            'penerbit_id' => 2,
            'kategori_id' => 2,
            'rak_id' => 4,
            'stok' => 10
        ]);

        Buku::create([
            'judul' => 'gusdur',
            'slug' => Str::slug('gusdur'),
            'sampul' => 'buku/gusdur.png',
            'penulis' => 'greg borton',
            'penerbit_id' => 2,
            'kategori_id' => 3,
            'rak_id' => 7,
            'stok' => 10
        ]);

        Buku::create([
            'judul' => 'habibie',
            'slug' => Str::slug('habibie'),
            'sampul' => 'buku/Habibie.png',
            'penulis' => 'raden toto sugiharto',
            'penerbit_id' => 2,
            'kategori_id' => 3,
            'rak_id' => 8,
            'stok' => 10
        ]);

        Buku::create([
            'judul' => 'naruto volume 58',
            'slug' => Str::slug('naruto-volume-58'),
            'sampul' => 'buku/naruto-78.png',
            'penulis' => 'masashi kishimoto',
            'penerbit_id' => 3,
            'kategori_id' => 6,
            'rak_id' => 12,
            'stok' => 10
        ]);

        Buku::create([
            'judul' => 'naruto volume 71',
            'slug' => Str::slug('naruto-volume-71'),
            'sampul' => 'buku/naruto-71.png',
            'penulis' => 'masashi kishimoto',
            'penerbit_id' => 3,
            'kategori_id' => 6,
            'rak_id' => 13,
            'stok' => 10
        ]);
    }
}
