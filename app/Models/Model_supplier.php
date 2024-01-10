<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_supplier extends Model
{
    protected $table            = 'supplier';
    protected $primaryKey       = 'kode_supplier';
    protected $allowedFields    = [
        'kode_supplier', 'nama_supplier', 'alamat_supplier', 'telepon_supplier', 'sprkode_pt'
    ];

    public function tampildata()
    {
        return $this->table('supplier')->join('data_pt','sprkode_pt=kode_pt');

        // $builder = $this->db->table('supplier');
        // $builder->join('data_pt', 'data_pt.kode_pt = supplier.sprkode_pt');
        // $query = $builder->get();
        // return $query->getResult();
    }

    public function tampildata_cari($cari)
    {
        return $this->table('supplier')->join('data_pt','sprkode_pt=kode_pt')->orlike('kode_supplier',$cari)->orlike('nama_supplier', $cari)->orlike('alamat_supplier', $cari)->orlike('telepon_supplier', $cari)->orlike('nama_pt', $cari);
    }
}