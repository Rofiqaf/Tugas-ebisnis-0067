<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_pembelian extends Model
{
    protected $table            = 'pembelian';
    protected $primaryKey       = 'kode_pembelian';
    protected $allowedFields    = [
        'kode_pembelian','tanggal_pembelian', 'supplier', 'kode_produk_dibeli', 'produk_dibeli', 'detail_ekor', 'detail_kg', 'jml_ekor', 'jml_kg', 'harga', 'harga_total', 'bukti'
    ];
    
    public function getGrafikData()
    {
        return $this->findAll();
    }
    public function getTotalB($bulan)
    {
        // Konversi bulan menjadi format dengan leading zero jika kurang dari 10
        $bulan = str_pad($bulan, 2, '0', STR_PAD_LEFT);

        // Query untuk menghitung total harga_total berdasarkan bulan
        $query = $this->selectSum('harga_total')
                      ->where('MONTH(tanggal_pembelian)', $bulan)
                      ->get();

        // Ambil hasil query
        $result = $query->getRow();

        // Return total harga_total
        return $result->harga_total;
    }
}