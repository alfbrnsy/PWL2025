<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kategori_id' => 1, 'kategori_kode' => 'ATM', 'kategori_nama' => 'Alat Makan'],
            ['kategori_id' => 2, 'kategori_kode' => 'PRK', 'kategori_nama' => 'Perkakas'],
            ['kategori_id' => 3, 'kategori_kode' => 'MNM', 'kategori_nama' => 'Minuman'],
            ['kategori_id' => 4, 'kategori_kode' => 'PKB', 'kategori_nama' => 'Perlengkapan Bengkel'],
            ['kategori_id' => 5, 'kategori_kode' => 'TKN', 'kategori_nama' => 'Teknologi'],
        ];
        
        DB::table('m_kategori')->insert($data);
    }
}
