<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_produk extends Model
{
    protected $table            = 'produk';
    protected $primaryKey       = 'kode_produk';
    protected $allowedFields    = [
        'kode_produk', 'nama_produk', 'harga_beliperkg', 'harga_jualperkg', 'stok_perkg', 'stok_perekor'
    ];

    //public function tampildata()
    //{
    //    return $this->table('produk')->join('supplier','nama_produk=kode_supplier')->get();
    //}
}
