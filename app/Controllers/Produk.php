<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Model_produk;
use App\Models\Model_supplier;

class Produk extends BaseController
{
    public $produk = '';
    public function __construct()
    {
        $this->produk = new Model_produk();
    }

    public function index()
    {
        $model = new Model_produk();
        $data['tampildata'] = $model->findAll();
        return view('produk/viewproduk', $data);
    }

    public function tambah()
    {
        return view('produk/formtambah');
    }
    public function simpandata()
    {
        $kode_produk = $this->request->getVar('kode_produk');
        $nama_produk = $this->request->getVar('nama_produk');
        $harga_beliperkg = $this->request->getVar('harga_beliperkg');
        $harga_jualperkg = $this->request->getVar('harga_jualperkg');
        $stok_perkg = $this->request->getVar('stok_perkg');
        $stok_perekor = $this->request->getVar('stok_perekor');

        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'kode_produk' => [
                'rules'=> 'required|is_unique[produk.kode_produk]',
                'label'=> 'Kode Produk',
                'errors'=> [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field}sudah ada, coba yang lain'
                ]
            ],
            'nama_produk' => [
                'rules' => 'required',
                'label' => 'Nama Produk',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'harga_beliperkg' => [
                'rules' => 'required|numeric',
                'label' => 'Harga Beli/Kg',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} hanya dalam bentuk angka'
                ]
            ],
            'harga_jualperkg' => [
                'rules' => 'required|numeric',
                'label' => 'Harga Jual/Kg',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} hanya dalam bentuk angka'
                ]
            ],
            'stok_perkg' => [
                'rules' => 'required|numeric',
                'label' => 'Stok/Kg',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} hanya dalam bentuk angka'
                ]
            ],
            'stok_perekor' => [
                'rules' => 'required|numeric',
                'label' => 'Stok/Ekor',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} hanya dalam bentuk angka'
                ]
            ]
        ]);

        if (!$valid) {
            $pesan = [
                'error' => '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>' . $validation->listErrors() . '</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/produk/tambah');
        }else {
            $this->produk->insert([
                'kode_produk' => $kode_produk, 'nama_produk' => $nama_produk, 'harga_beliperkg' => $harga_beliperkg, 'harga_jualperkg' => $harga_jualperkg, 'stok_perkg' => $stok_perkg, 'stok_perekor' => $stok_perekor
            ]);

            $pesan = [
                'sukses' => '<div class ="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>Data Supplier dengan kode <strong>'.$kode_produk.' </strong> berhasil disimpan...</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/produk/index');
        }
    }

    public function edit($kode)
    {
        $cekData = $this->produk->find($kode);

        if($cekData){

            $modelsupplier = new Model_supplier();

            $data = [
                'kode_produk' => $cekData['kode_produk'],
                'nama_produk' => $cekData['nama_produk'],
                'harga_beliperkg' => $cekData['harga_beliperkg'],
                'harga_jualperkg' => $cekData['harga_jualperkg'],
                'stok_perkg' => $cekData['stok_perkg'],
                'stok_perekor' => $cekData['stok_perekor'],
                'datasupplier' => $modelsupplier->findAll()
            ];
            return view('produk/formedit', $data);

        }else{
            $pesan = [
                'error' => '<div class ="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden"true">x</button> <h5><i class="icon fas fa-ban"></i> Error !</h5>Data Produk tidak ditemukan...</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/produk/index');
        }

    }

    public function updatedata()
    {
        $kode_produk = $this->request->getVar('kode_produk');
        $nama_produk = $this->request->getVar('nama_produk');
        $harga_beliperkg = $this->request->getVar('harga_beliperkg');
        $harga_jualperkg = $this->request->getVar('harga_jualperkg');
        $stok_perkg = $this->request->getVar('stok_perkg');
        $stok_perekor = $this->request->getVar('stok_perekor');

        $validation = \Config\Services::validation();

        $valid = $this->validate([
            // 'kode_produk' => [
            //     'rules'=> 'required|is_unique[produk.kode_produk]',
            //     'label'=> 'Kode Produk',
            //     'errors'=> [
            //         'required' => '{field} tidak boleh kosong',
            //         'is_unique' => '{field}sudah ada, coba yang lain'
            //     ]
            // ],
            'nama_produk' => [
                'rules' => 'required',
                'label' => 'Nama Produk',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'harga_beliperkg' => [
                'rules' => 'required|numeric',
                'label' => 'Harga Beli/Kg',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} hanya dalam bentuk angka'
                ]
            ],
            'harga_jualperkg' => [
                'rules' => 'required|numeric',
                'label' => 'Harga Jual/Kg',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} hanya dalam bentuk angka'
                ]
            ],
            'stok_perkg' => [
                'rules' => 'required|numeric',
                'label' => 'Stok/Kg',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} hanya dalam bentuk angka'
                ]
            ],
            'stok_perekor' => [
                'rules' => 'required|numeric',
                'label' => 'Stok/Ekor',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} hanya dalam bentuk angka'
                ]
            ]
        ]);

        if (!$valid) {
            $pesan = [
                'error' => '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>' . $validation->listErrors() . '</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/produk/edit/' .$kode_produk);
        }else {
            $this->produk->update($kode_produk,[
                'nama_produk' => $nama_produk, 'harga_beliperkg' => $harga_beliperkg, 'harga_jualperkg' => $harga_jualperkg, 'stok_perkg' => $stok_perkg, 'stok_perekor' => $stok_perekor
            ]);

            $pesan = [
                'sukses' => '<div class ="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>Data Produk dengan kode <strong>'.$kode_produk.' </strong> berhasil diperbarui...</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/produk/index');
        } 
    }

    public function hapus($kode)
    {
        $cekData = $this->produk->find($kode);

        if ($cekData) {

            $this->produk->delete($kode);
            $pesan = [
                'sukses' => '<div class ="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden"true">x</button>Data Produk dengan kode <strong>'.$kode.' </strong> berhasil dihapus...</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/produk/index');

        }else{
            $pesan = [
                'error' => '<div class ="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden"true">x</button> <h5><i class="icon fas fa-ban"></i> Error !</h5>Data Produk tidak ditemukan...</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/produk/index');
        }
    }
    
}
