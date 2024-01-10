<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_data_pt extends Model
{
    protected $table            = 'data_pt';
    protected $primaryKey       = 'kode_pt';
    protected $allowedFields    = [
        'kode_pt', 'nama_pt', 'alamat_pt', 'telepon_pt'
    ];

    public function tampildata_cari($cari)
    {
        return $this->table('data_pt')->orlike('kode_pt',$cari)->orlike('nama_pt', $cari)->orlike('alamat_pt', $cari)->orlike('telepon_pt', $cari);
    }
}
