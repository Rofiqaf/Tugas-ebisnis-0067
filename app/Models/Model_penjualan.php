<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_penjualan extends Model
{
    protected $table            = 'penjualan';
    protected $primaryKey       = 'kode_penjualan';
    protected $allowedFields    = [
        'kode_penjualan','no_perbulan','bulan','tanggal_penjualan','customer','kode_produk_dijual','produk','detail_ekor','detail_kg','ekor','kg','harga','totalHarga','bayar','kembalian','status'
    ];

    public function getGrafikData()
    {
        return $this->findAll();
    }
    public function getTotalJ($bulan)
    {
        // Konversi bulan menjadi format dengan leading zero jika kurang dari 10
        $bulan = str_pad($bulan, 2, '0', STR_PAD_LEFT);

        // Query untuk menghitung total harga_total berdasarkan bulan
        $query = $this->selectSum('totalHarga')
                      ->where('MONTH(tanggal_penjualan)', $bulan)
                      ->get();

        // Ambil hasil query
        $result = $query->getRow();

        // Return total harga_total
        return $result->totalHarga;
    }
}