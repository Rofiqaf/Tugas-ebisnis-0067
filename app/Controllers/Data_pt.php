<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Model_data_pt;

use function PHPSTORM_META\exitPoint;

class Data_pt extends BaseController
{
    // public $data_pt = '';
    protected $data_pt;
    public function __construct()
    {
        $this->data_pt = new Model_data_pt();
    }
    public function index()
    {
        $tombolcari = $this->request->getPost('tombolcari');

        if(isset($tombolcari)) {
            $cari = $this->request->getPost('cari');
            session()->set('cari_data_pt', $cari);
            redirect()->to('/data_pt/index');
        }else{
            $cari = session()->get('cari_data_pt');
        }

        $totaldata = $cari ? $this->data_pt->tampildata_cari($cari)->countAllResults() : $this->data_pt->countAllResults();

        $dataPt = $cari ? $this->data_pt->tampildata_cari($cari)->paginate(5, 'data_pt') : $this->data_pt->paginate(5, 'data_pt');

        $nohalaman = $this->request->getVar('page_data_pt') ? $this->request->getVar('page_data_pt') : 1;

        $data = [
            'tampildata' => $dataPt,
            'pager' => $this->data_pt->pager,
            'nohalaman' => $nohalaman,
            'totaldata' => $totaldata,
            'cari' => $cari
        ];
        return view('data_pt/viewdata_pt', $data);
    }

    public function formtambah()
    {
        return view('data_pt/formtambah');
    }

    public function simpandata()
    {
        // $data = [
        //     'kode_pt' => $this->request->getpost('kode_pt'),
        //     'nama_pt' => $this->request->getpost('nama_pt'),
        //     'alamat_pt' => $this->request->getpost('alamat_pt'),
        //     'telepon_pt' => $this->request->getpost('telepon_pt'),
        // ];

        // $data_pt = new Model_data_pt();
        // $simpan = $data_pt->simpan($data);
        // if ($simpan) {
        //     return redirect()->to('data_pt/index');
        // }

        // $validation = \Config\Services::validation();
        // $valid = $this->validate([
        //     'kode_pt','nama_pt', 'alamat_pt','telepon_pt' =>[
        //         'rules' => 'required',
        //         'label' => 'Kode PT','Nama PT', 'Alamat PT','Telepon PT',
        //         'errors' => [
        //             'required' => '{filed} tidak boleh kosong'
        //         ]
        //     ]
        // ]);



        $kode_pt = $this->request->getVar('kode_pt');
        $nama_pt = $this->request->getVar('nama_pt');
        $alamat_pt = $this->request->getVar('alamat_pt');
        $telepon_pt = $this->request->getVar('telepon_pt');
        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'kode_pt' => [
                'rules' => 'required|is_unique[data_pt.kode_pt]',
                'label' => 'Kode PT',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada, coba yang lain'
                ]
            ],
            'nama_pt' => [
                'rules' => 'required',
                'label' => 'Nama PT',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'telepon_pt' => [
                'rules' => 'numeric',
                'label' => 'Telepon PT',
                'errors' => [
                    'numeric' => '{field} hanya dalam bentuk angka'
                ]
            ]
        ]);

        if (!$valid) {
            $pesan = [
                'errorKodePt' => '<br><div ">' . $validation->getError('kode_pt') . '</div>',
                'errorNamaPt' => '<br><div ">' . $validation->getError('nama_pt') . '</div>',
                'errorTeleponPt' => '<br><div ">' . $validation->getError('telepon_pt') . '</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/data_pt/formtambah');
        } else {
            $this->data_pt->insert([
                'kode_pt' => $kode_pt, 'nama_pt' => $nama_pt, 'alamat_pt' => $alamat_pt, 'telepon_pt' => $telepon_pt
            ]);

            $pesan = [
                'sukses' => '<div class ="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>Data PT dengan kode <strong>'.$kode_pt.' </strong> berhasil ditambahkan...</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/data_pt/index');
        }
    }

    public function formedit($kode)
    {
        $rowData = $this->data_pt->find($kode);

        if ($rowData) {

            $data = [
                'kode' => $kode,
                'nama' => $rowData['nama_pt'],
                'alamat' => $rowData['alamat_pt'],
                'telepon' => $rowData['telepon_pt'],
            ];
            return view('data_pt/formedit', $data);
        } else {
            exit('Data tidak ditemukan');
        }
    }

    public function editdata()
    {
        $kode_pt = $this->request->getVar('kode_pt');
        $nama_pt = $this->request->getVar('nama_pt');
        $alamat_pt = $this->request->getVar('alamat_pt');
        $telepon_pt = $this->request->getVar('telepon_pt');
        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'kode_pt' => [
                'rules' => 'required',
                'label' => 'Kode PT',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada, coba yang lain'
                ]
            ],
            'nama_pt' => [
                'rules' => 'required',
                'label' => 'Nama PT',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            // 'telepon_pt' => [
            //     'rules' => 'numeric',
            //     'label' => 'Telepon PT',
            //     'errors' => [
            //         'numeric' => '{field} hanya dalam bentuk angka'
            //     ]
            // ]
        ]);

        if (!$valid) {
            $pesan = [
                'errorKodePt' => '<br><div ">' . $validation->getError('kode_pt') . '</div>',
                'errorNamaPt' => '<br><div ">' . $validation->getError('nama_pt') . '</div>',
                'errorTeleponPt' => '<br><div ">' . $validation->getError('telepon_pt') . '</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/data_pt/formedit/'. $kode_pt);
        } else {
            $this->data_pt->update($kode_pt,[
                'kode_pt' => $kode_pt, 'nama_pt' => $nama_pt, 'alamat_pt' => $alamat_pt, 'telepon_pt' => $telepon_pt
            ]);

            $pesan = [
                'sukses' => '<div class ="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button> <i class="icon fas fa-check"></i> Data PT dengan kode <strong>'.$kode_pt.' </strong> berhasil diperbarui...</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/data_pt/index');
        }
    }

    public function hapus($kode)
    {
        $rowData = $this->data_pt->find($kode);

        if ($rowData) {

            $this->data_pt->delete($kode);

            $pesan = [
                'sukses' => '<div class ="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button> <i class="icon fas fa-check"></i> Data PT dengan kode <strong>'.$kode.' </strong> berhasil dihapus...</div>'
            ];
            session()->setFlashdata($pesan);
            return redirect()->to('/data_pt/index');

        }else{
            exit('Data tidak ditemukan');
        }
    }
}
