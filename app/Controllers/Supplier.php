<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Model_supplier;
use App\Models\Model_data_pt;

class Supplier extends BaseController
{
    public $supplier = '';
    public function __construct()
    {
        $this->supplier = new Model_supplier();
    }
    public function index()
    {
        $tombolcari = $this->request->getPost('tombolcari');

        if(isset($tombolcari)) {
            $cari = $this->request->getPost('cari');
            session()->set('cari_supplier', $cari);
            redirect()->to('/supplier/index');
        }else{
            $cari = session()->get('cari_supplier');
        }

        $totaldata = $cari ? $this->supplier->tampildata_cari($cari)->countAllResults() : $this->supplier->tampildata()->countAllResults();

        $dataSupplier = $cari ? $this->supplier->tampildata_cari($cari)->paginate(5, 'supplier') : $this->supplier->tampildata()->paginate(5, 'supplier');

        $nohalaman = $this->request->getVar('page_supplier') ? $this->request->getVar('page_supplier') : 1;

        $data = [
            'tampildata' => $dataSupplier,
            'pager' => $this->supplier->pager,
            'nohalaman' => $nohalaman,
            'totaldata' => $totaldata,
            'cari' => $cari
        ];
        return view('supplier/viewsupplier', $data);
    }

    public function tambah()
    {
        $modelData_pt = new Model_data_pt();

        $data = [
            'datapt' => $modelData_pt->findAll()
        ];
        return view('supplier/formtambah', $data);
    }

    public function simpandata()
    {
        $kode_supplier = $this->request->getVar('kode_supplier');
        $nama_supplier = $this->request->getVar('nama_supplier');
        $alamat_supplier = $this->request->getVar('alamat_supplier');
        $telepon_supplier = $this->request->getVar('telepon_supplier');
        $data_pt = $this->request->getVar('data_pt');

        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'kode_supplier' => [
                'rules' => 'required',
                'label' => 'Kode Supplier',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada, coba yang lain'
                ]
            ],
            'nama_supplier' => [
                'rules' => 'required',
                'label' => 'Nama Supplier',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'alamat_supplier' => [
                'rules' => 'required',
                'label' => 'Alamat Supplier',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'telepon_supplier' => [
                'rules' => 'required|numeric',
                'label' => 'Telepon Supplier',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} hanya dalam bentuk angka'
                ]
            ],
            'data_pt' => [
                'rules' => 'required',
                'label' => 'Data PT',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ]
        ]);

        if (!$valid) {
            $pesan = [
                'error' => '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>' . $validation->listErrors() . '</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/supplier/tambah');
        }else {
            $this->supplier->insert([
                'kode_supplier' => $kode_supplier, 'nama_supplier' => $nama_supplier, 'alamat_supplier' => $alamat_supplier, 'telepon_supplier' => $telepon_supplier, 'sprkode_pt' => $data_pt
            ]);

            $pesan = [
                'sukses' => '<div class ="alert alert-success">Data Supplier dengan kode <strong>'.$kode_supplier.' </strong> berhasil disimpan...</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/supplier/index');
        }
    }

    public function edit($kode)
    {
        $cekData = $this->supplier->find($kode);

        if($cekData){

            $modeldatapt = new Model_data_pt();

            $data = [
                'kodesupplier' => $cekData['kode_supplier'],
                'namasupplier' => $cekData['nama_supplier'],
                'alamatsupplier' => $cekData['alamat_supplier'],
                'teleponsupplier' => $cekData['telepon_supplier'],
                'supdata_pt' => $cekData['sprkode_pt'],
                'datapt' => $modeldatapt->findAll()
            ];
            return view('supplier/formedit', $data);

        }else{
            $pesan = [
                'error' => '<div class ="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden"true">x</button> <h5><i class="icon fas fa-ban"></i> Error !</h5>Data Supplier tidak ditemukan...</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/supplier/index');
        }

    }

    public function updatedata()
    {
        $kode_supplier = $this->request->getVar('kode_supplier');
        $nama_supplier = $this->request->getVar('nama_supplier');
        $alamat_supplier = $this->request->getVar('alamat_supplier');
        $telepon_supplier = $this->request->getVar('telepon_supplier');
        $data_pt = $this->request->getVar('data_pt');

        $validation = \Config\Services::validation();
        $valid = $this->validate([
            // 'kode_supplier' => [
            //     'rules' => 'required',
            //     'label' => 'Kode Supplier',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'is_unique' => '{field} sudah ada, coba yang lain'
            //     ]
            // ],
            'nama_supplier' => [
                'rules' => 'required',
                'label' => 'Nama Supplier',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'alamat_supplier' => [
                'rules' => 'required',
                'label' => 'Alamat Supplier',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'telepon_supplier' => [
                'rules' => 'required|numeric',
                'label' => 'Telepon Supplier',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} hanya dalam bentuk angka'
                ]
            ],
            'data_pt' => [
                'rules' => 'required',
                'label' => 'Data PT',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ]
        ]);

        if (!$valid) {
            $pesan = [
                'error' => '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>' . $validation->listErrors() . '</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/supplier/edit/' . $kode_supplier);
        }else {
            $cekData = $this->supplier->find($kode_supplier);

            $this->supplier->update($kode_supplier,[
                'nama_supplier' => $nama_supplier, 'alamat_supplier' => $alamat_supplier, 'telepon_supplier' => $telepon_supplier, 'sprkode_pt' => $data_pt
            ]);
            $pesan = [
                'sukses' => '<div class ="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden"true">x</button>Data Supplier dengan kode <strong>'.$kode_supplier.' </strong> berhasil diperbarui...</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/supplier/index');
        }  
    }

    public function hapus($kode)
    {
        $cekData = $this->supplier->find($kode);

        if ($cekData) {

            $this->supplier->delete($kode);
            $pesan = [
                'sukses' => '<div class ="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden"true">x</button>Data Supplier dengan kode <strong>'.$kode.' </strong> berhasil dihapus...</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/supplier/index');

        }else{
            $pesan = [
                'error' => '<div class ="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden"true">x</button> <h5><i class="icon fas fa-ban"></i> Error !</h5>Data Supplier tidak ditemukan...</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/supplier/index');
        }
    }

}
