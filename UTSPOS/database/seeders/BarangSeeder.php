<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $data = [
        ['barang_id' => 1, 'kategori_id' => 1, 'barang_kode' => 'SDM001', 'barang_nama' => 'Sendok Makan', 'harga_beli' => 10000, 'harga_jual' => 15000],
        ['barang_id' => 2, 'kategori_id' => 1, 'barang_kode' => 'PRM001', 'barang_nama' => 'Piring Makan', 'harga_beli' => 15000, 'harga_jual' => 20000],
        ['barang_id' => 3, 'kategori_id' => 2, 'barang_kode' => 'PAL001', 'barang_nama' => 'Palu', 'harga_beli' => 50000, 'harga_jual' => 60000],
        ['barang_id' => 4, 'kategori_id' => 2, 'barang_kode' => 'GRJ001', 'barang_nama' => 'Gergaji', 'harga_beli' => 70000, 'harga_jual' => 80000],
        ['barang_id' => 5, 'kategori_id' => 3, 'barang_kode' => 'TEH001', 'barang_nama' => 'Teh Kotak', 'harga_beli' => 10000, 'harga_jual' => 15000],
        ['barang_id' => 6, 'kategori_id' => 3, 'barang_kode' => 'KPI001', 'barang_nama' => 'Kopi Hitam', 'harga_beli' => 2000, 'harga_jual' => 5000],
        ['barang_id' => 7, 'kategori_id' => 4, 'barang_kode' => 'SBN001', 'barang_nama' => 'Sabun Mandi LB', 'harga_beli' => 5000, 'harga_jual' => 10000],
        ['barang_id' => 8, 'kategori_id' => 4, 'barang_kode' => 'SMP001', 'barang_nama' => 'Shampoo Selsun', 'harga_beli' => 15000, 'harga_jual' => 20000],
        ['barang_id' => 9, 'kategori_id' => 5, 'barang_kode' => 'KPS001', 'barang_nama' => 'Kipas Angin', 'harga_beli' => 50000, 'harga_jual' => 80000],
        ['barang_id' => 10,'kategori_id' => 5, 'barang_kode' => 'MSC001', 'barang_nama' => 'Mesin Cuci', 'harga_beli' => 500000, 'harga_jual' => 600000],
    ];
    DB::table('m_barang')->insert($data);
}

}