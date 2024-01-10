<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Model_penjualan;
use App\Models\Model_supplier;
use App\Models\Model_produk;
use App\Models\Model_produkajax;

class Penjualan extends BaseController
{
    public $penjualan = '';
    public function __construct()
    {
        $this->penjualan = new Model_penjualan();
    }

    public function index()
    {
        // Mengambil semua data penjualan
        $model = new Model_penjualan();

        // Mengambil semua data dari tabel
        $data['penjualan'] = $model->findAll();
        $data['totaldata'] = $model->countAll();

        // Menampilkan view dengan data
        return view('penjualan/index', $data);
    }
    
    public function laporan()
    {
        return view('penjualan/laporan');
    }

    public function detaillaporan()
    {
        $tanggalAwal = $this->request->getPost('tanggal_awal');
        $tanggalAkhir = $this->request->getPost('tanggal_akhir');

        $model = new Model_penjualan;
        $data['awal'] = $tanggalAwal;
        $data['akhir'] = $tanggalAkhir;
        $data['hasil_query'] = $model
            ->where('tanggal_penjualan >=', $tanggalAwal)
            ->where('tanggal_penjualan <=', $tanggalAkhir)
            ->findAll();

        return view('penjualan/laporandetail', $data);
    }

    public function tambah()
    {
        $model0 = new Model_produkajax();
        $data['json_data'] = $model0->getDataFromDatabase();
        $model = new Model_produk();
        $model2 = new Model_supplier();
        $data['produk'] = $model->findAll();
        $data['supplier'] = $model2->findAll();

        $model3 = new Model_penjualan();
        $bulanini = date('m');
        $maxNoPerbulan = $model3->selectMax('no_perbulan')->where('bulan', $bulanini)->get();
        $result = $maxNoPerbulan->getRow();

        $data['maxNoPerbulan'] = $result->no_perbulan;
        
        return view('penjualan/tambah', $data);
    }

    public function simpandata()
    {
        $jual_kode = $this->request->getVar('jual_kode');
        $jual_tanggal = $this->request->getVar('jual_tanggal');
        $no_perbulan = $this->request->getVar('no_perbulanOK');
        $bulan = $this->request->getVar('bulan');
        $jual_customer = $this->request->getVar('jual_customer');
        $jual_produk = $this->request->getVar('jual_produk');
        $jual_detail_ekor = $this->request->getVar('jual_detail_ekor');
        $jual_detail_kg = $this->request->getVar('jual_detail_kg');
        $jual_ekor = $this->request->getVar('jual_ekor');
        $jual_kg = $this->request->getVar('jual_kg');
        $jual_harga = $this->request->getVar('jual_harga');
        $jual_totalHarga = $this->request->getVar('jual_totalHarga');
        $jual_bayar = $this->request->getVar('jual_bayar');
        $jual_kembalian = $this->request->getVar('jual_kembalian');
        $jual_status = $this->request->getVar('jual_status');
        $stokKgAkhir = $this->request->getVar('stokKgAkhir');
        $stokEkAkhir = $this->request->getVar('stokEkAkhir');

        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'jual_kode' => [
                'rules' => 'required|is_unique[penjualan.kode_penjualan]|max_length[99]',
                'label' => 'Kode penjualan',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'max_length' => '{field} tidak boleh lebih dari 99 karakter',
                    'is_unique' => '{field} sudah ada, coba yang lain'
                ]
            ],
            'jual_tanggal' => [
                'rules' => 'required',
                'label' => 'Tanggal penjualan',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'jual_customer' => [
                'rules' => 'required',
                'label' => 'Nama Customer',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'jual_produk' => [
                'rules' => 'required',
                'label' => 'Produk',
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
            return redirect()->to('/penjualan/tambah');
        }else {

            $prd = explode("#", $jual_produk);
            $kodeprd = trim($prd[0]);
            $namaprd = trim($prd[1]);

            $this->penjualan->insert([
                'kode_penjualan' => $jual_kode,
                'no_perbulan' => $no_perbulan,
                'bulan' => $bulan,
                'tanggal_penjualan' => $jual_tanggal,
                'customer' => $jual_customer,
                'kode_produk_dijual' => $kodeprd,
                'produk' => $namaprd,
                'detail_ekor' => $jual_detail_ekor,
                'detail_kg' => $jual_detail_kg,
                'ekor' => $jual_ekor,
                'kg' => $jual_kg,
                'harga' => $jual_harga,
                'totalHarga' => $jual_totalHarga,
                'bayar' => $jual_bayar,
                'kembalian' => $jual_kembalian,
                'status' => $jual_status
            ]);

            // update data stok di 'produk'
            $model = new Model_produk();
            $model->where('kode_produk', $kodeprd);

            $data = [
                'stok_perkg' => $stokKgAkhir,
                'stok_perekor' => $stokEkAkhir,
            ];

            $model->set($data, null, false)->update();
            // akhir update

            $pesan = [
                'sukses' => '<div class ="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>Data transaksi dengan kode <strong>'.$jual_kode.' </strong> berhasil disimpan...</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/penjualan/index');
        }
    }

    public function hapus(...$kode0)
    {
        $kode = implode('/', $kode0);

        $cekData = $this->penjualan->find($kode);

        if ($cekData) {
            $kodeProduke = $cekData['kode_produk_dijual'];
            $jualEk_ = $cekData['ekor'];
            $jualKg_ = $cekData['kg'];
            // update data stok di 'produk'
            $model = new Model_produk();
            $model->where('kode_produk', $kodeProduke);

            $data = [
                'stok_perkg' => 'stok_perkg + ' . $jualKg_,
                'stok_perekor' => 'stok_perekor + ' . $jualEk_,
            ];

            $model->set($data, null, false)->update();
            // akhir update

            $this->penjualan->delete($kode);

            $pesan = [
                'sukses' => '<div class ="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden"true">x</button>Data dengan kode <strong>'.$kode.'</strong> berhasil dihapus..., dan stok produk '.$kodeProduke.' telah berhasil dikembalikan.</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/penjualan/index');

        }else{
            $pesan = [
                'error' => '<div class ="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden"true">x</button> <h5><i class="icon fas fa-ban"></i> Error !</h5>Data tidak ditemukan...</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/penjualan/index');
        }
    }
    public function detail(...$kode0)
    {
        $kode = implode('/', $kode0);

        $cekData = $this->penjualan->find($kode);

        if ($cekData) {
            
            $model = new Model_penjualan();
            $data['detail'] = $model->find($kode);
            return view('penjualan/detailpenjualan', $data);
        }else{
            $pesan = [
                'error' => '<div class ="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden"true">x</button> <h5><i class="icon fas fa-ban"></i> Error !</h5>Data tidak ditemukan...</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/penjualan/index');
        }
    }
    public function edit(...$kode0)
    {
        $kode = implode('/', $kode0);

        $cekData = $this->penjualan->find($kode);

        if ($cekData) {
            $model0 = new Model_produkajax();
            $data['json_data'] = $model0->getDataFromDatabase();
            $kode_p = $cekData['kode_produk_dijual'];
            $model1 = new Model_produk();
            $data['produk'] = $model1->findAll();
            $data['detailproduk'] = $model1->find($kode_p);
            $data['detail'] = $cekData;
            return view('penjualan/editpenjualan', $data);
        }else{
            $pesan = [
                'error' => '<div class ="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden"true">x</button> <h5><i class="icon fas fa-ban"></i> Error !</h5>Data tidak ditemukan...</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/penjualan/index');
        }
    }

    public function nota(...$kode0)
    {
        $kode = implode('/', $kode0);

        $cekData = $this->penjualan->find($kode);

        if ($cekData) {
            
            $model = new Model_penjualan();
            $data['detail'] = $model->find($kode);
            return view('penjualan/cetaknota', $data);
        }else{
            $pesan = [
                'error' => '<div class ="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden"true">x</button> <h5><i class="icon fas fa-ban"></i> Error !</h5>Data tidak ditemukan...</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/penjualan/index');
        }
    }

    public function updatedata()
    {
        $jual_kode = $this->request->getVar('jual_kode');
        $jual_tanggal = $this->request->getVar('jual_tanggal');
        $jual_customer = $this->request->getVar('jual_customer');
        $jual_produk = $this->request->getVar('jual_produk');
        $jual_detail_ekor = $this->request->getVar('jual_detail_ekor');
        $jual_detail_kg = $this->request->getVar('jual_detail_kg');

        $jual_ekor = $this->request->getVar('jual_ekor');
        $jual_ekor_sekarang = $this->request->getVar('jual_ekor_sekarang');

        $jual_kg = $this->request->getVar('jual_kg');
        $jual_kg_sekarang = $this->request->getVar('jual_kg_sekarang');

        $jual_harga = $this->request->getVar('jual_harga');
        $jual_totalHarga = $this->request->getVar('jual_totalHarga');
        $jual_bayar = $this->request->getVar('jual_bayar');
        $jual_kembalian = $this->request->getVar('jual_kembalian');
        $jual_status = $this->request->getVar('jual_status');
        $stokKgAkhir = $this->request->getVar('stokKgAkhir');
        $stokEkAkhir = $this->request->getVar('stokEkAkhir');

        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'jual_bayar' => [
                'rules' => 'required',
                'label' => 'Nominal Pembayaran',
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
            return redirect()->to('/penjualan/edit');
        }else {

            $prd = explode("#", $jual_produk);
            $kodeprd = trim($prd[0]);
            $namaprd = trim($prd[1]);

            // update data di 'penjualan'
            $model0 = new Model_penjualan();
            $model0->where('kode_penjualan', $jual_kode);

            $data = [
                'tanggal_penjualan' => $jual_tanggal,
                'customer' => $jual_customer,
                'kode_produk_dijual' => $kodeprd,
                'produk' => $namaprd,
                'detail_ekor' => $jual_detail_ekor,
                'detail_kg' => $jual_detail_kg,
                'ekor' => $jual_ekor,
                'kg' => $jual_kg,
                'harga' => $jual_harga,
                'totalHarga' => $jual_totalHarga,
                'bayar' => $jual_bayar,
                'kembalian' => $jual_kembalian,
                'status' => $jual_status
            ];
            $model0->update(['kode_penjualan' => $jual_kode],$data);

            // update data stok di 'produk'
            $model1 = new Model_produk();
            $data1 = [
                'stok_perkg' => $jual_kg_sekarang,
                'stok_perekor' => $jual_ekor_sekarang
            ];
            $model1->update(['kode_produk' => $kodeprd],$data1);

            $pesan = [
                'sukses' => '<div class ="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>Data transaksi dengan kode <strong>'.$jual_kode.' </strong> berhasil diedit...</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/penjualan/index');
        }
    }
}