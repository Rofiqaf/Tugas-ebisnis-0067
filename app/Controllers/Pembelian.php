<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Model_pembelian;
use App\Models\Model_supplier;
use App\Models\Model_produk;

class Pembelian extends BaseController
{
    public $pembelian = '';
    public $produk = '';
    public function __construct()
    {
        $this->pembelian = new Model_pembelian();
        $this->produk = new Model_produk();
    }

    public function index()
    {
        // Mengambil semua data pembelian
        $model = new Model_pembelian();

        // Mengambil semua data dari tabel
        $data['pembelian'] = $model->findAll();
        $data['totaldata'] = $model->countAll();

        // Menampilkan view dengan data
        return view('pembelian/index', $data);
    }

    public function laporan()
    {
        return view('pembelian/laporan');
    }

    public function detaillaporan()
    {
        $tanggalAwal = $this->request->getPost('tanggal_awal');
        $tanggalAkhir = $this->request->getPost('tanggal_akhir');

        $model = new Model_pembelian;
        $data['awal'] = $tanggalAwal;
        $data['akhir'] = $tanggalAkhir;
        $data['hasil_query'] = $model
            ->where('tanggal_pembelian >=', $tanggalAwal)
            ->where('tanggal_pembelian <=', $tanggalAkhir)
            ->findAll();

        return view('pembelian/laporandetail', $data);
    }

    public function tambah()
    {
        $model = new Model_produk();
        $model2 = new Model_supplier();
        $data['produk'] = $model->findAll();
        $data['supplier'] = $model2->findAll();

        return view('pembelian/tambah', $data);
    }

    public function simpandata()
    {
        $beli_kode = $this->request->getVar('beli_kode');
        $beli_tanggal = $this->request->getVar('beli_tanggal');
        $beli_supplier = $this->request->getVar('beli_supplier');
        $beli_produk = $this->request->getVar('beli_produk');
        $beli_detail_ekor = $this->request->getVar('beli_detail_ekor');
        $beli_detail_kg = $this->request->getVar('beli_detail_kg');
        $beli_ekor = $this->request->getVar('beli_ekor');
        $beli_kg = $this->request->getVar('beli_kg');
        $beli_harga = $this->request->getVar('beli_harga');
        $beli_hargaJual = $this->request->getVar('beli_hargaJual');
        $beli_totalHarga = $this->request->getVar('beli_totalHarga');
        $beli_bukti = $this->request->getFile('beli_bukti');

        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'beli_kode' => [
                'rules' => 'required|is_unique[pembelian.kode_pembelian]|max_length[99]',
                'label' => 'Kode Pembelian',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'max_length' => '{field} tidak boleh lebih dari 99 karakter',
                    'is_unique' => '{field} sudah ada, coba yang lain'
                ]
            ],
            'beli_tanggal' => [
                'rules' => 'required',
                'label' => 'Tanggal Pembelian',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'beli_supplier' => [
                'rules' => 'required',
                'label' => 'Nama Supplier',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'beli_produk' => [
                'rules' => 'required',
                'label' => 'Produk',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'beli_detail_ekor' => [
                'rules' => 'required',
                'label' => 'Detail Ekor',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'beli_detail_kg' => [
                'rules' => 'required',
                'label' => 'Detail Kg',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'beli_ekor' => [
                'rules' => 'required',
                'label' => 'Ekor',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'beli_kg' => [
                'rules' => 'required',
                'label' => 'Kg',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'beli_harga' => [
                'rules' => 'required',
                'label' => 'Harga Satuan',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'beli_hargaJual' => [
                'rules' => 'required',
                'label' => 'Harga Jual Satuan',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'beli_totalHarga' => [
                'rules' => 'required',
                'label' => 'Total Harga',
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
            return redirect()->to('/pembelian/tambah');
        }else {       
            // upload file     
            $file = $this->request->getFile('beli_bukti');
            if($file==""){
                $namaFile = "";
            }else{
                if ($file->isValid() && !$file->hasMoved())
                {
                    $newName = $beli_kode;
                    $extension = $file->getExtension();
                    $namaFile = $newName . '.' . $extension;
                    $file->move(ROOTPATH . 'public/bukti_beli', $namaFile,true);
                }
                else
                {
                    $pesan = [
                        'sukses' => '<div class ="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>Bukti pembelian tidak dapat diunggah!</div>'
                    ];
        
                    session()->setFlashdata($pesan);
                    return redirect()->to('/pembelian/index');
                }
            }
            // pisah $beli_produk
            $prd = explode("#", $beli_produk);
            $kodeprd = trim($prd[0]);
            $namaprd = trim($prd[1]);
            
            // insert data ke 'pembelian'
            $this->pembelian->insert([
                'kode_pembelian'=> $beli_kode,
                'tanggal_pembelian' => $beli_tanggal,
                'supplier' => $beli_supplier,
                'kode_produk_dibeli' => $kodeprd,
                'produk_dibeli' => $namaprd,
                'detail_ekor' => $beli_detail_ekor,
                'detail_kg' => $beli_detail_kg,
                'jml_ekor' => $beli_ekor,
                'jml_kg' => $beli_kg,
                'harga' => $beli_harga,
                'harga_total' => $beli_totalHarga,
                'bukti' => $namaFile
            ]);

            // update data stok di 'produk'
            $model = new Model_produk();
            $model->where('kode_produk', $kodeprd);

            $data = [
                'harga_beliperkg' => $beli_harga,
                'harga_jualperkg' => $beli_hargaJual,
                'stok_perkg' => 'stok_perkg + ' . $beli_kg,
                'stok_perekor' => 'stok_perekor + ' . $beli_ekor,
            ];

            $model->set($data, null, false)->update();
            
            // pesan
            $pesan = [
                'sukses' => '<div class ="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>Data transaksi dengan kode <strong>'.$beli_kode.' </strong> berhasil disimpan...</div><script>localStorage.setItem("dataBeli",0)</script>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/pembelian/index');
        }
    }

    public function hapus(...$kode0)
    {
        $kode = implode('/', $kode0);

        $cekData = $this->pembelian->find($kode);

        if ($cekData) {
            //hapus gambar
            $fileName = $cekData['bukti'];
            if($fileName){
            $pathToImage = FCPATH . 'bukti_beli/' . $fileName;
            unlink($pathToImage);
            }
            //hapus row data
            $this->pembelian->delete($kode);

            $pesan = [
                'sukses' => '<div class ="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden"true">x</button>Data dengan kode <strong>'.$kode.' </strong> berhasil dihapus...</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/pembelian/index');

        }else{
            $pesan = [
                'error' => '<div class ="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden"true">x</button> <h5><i class="icon fas fa-ban"></i> Error !</h5>Data tidak ditemukan...</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/pembelian/index');
        }
    }
    public function detail(...$kode0)
    {
        $kode = implode('/', $kode0);
        
        $cekData = $this->pembelian->find($kode);

        if ($cekData) {
            $model = new Model_pembelian();
            $data['detail'] = $model->find($kode);
            return view('pembelian/detailpembelian', $data);
        }else{
            $pesan = [
                'error' => '<div class ="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden"true">x</button> <h5><i class="icon fas fa-ban"></i> Error !</h5>Data tidak ditemukan...</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/pembelian/index');
        }
    }
    public function edit(...$kode0)
    {
        $kode = implode('/', $kode0);
        
        $model0 = new Model_pembelian();
        $cekData = $model0->find($kode);

        if ($cekData) {
            $kode_p = $cekData['kode_produk_dibeli'];
            $model1 = new Model_produk();
            $model2 = new Model_supplier();
            
            $data['produk'] = $model1->findAll();
            $data['detailproduk'] = $model1->find($kode_p);
            $data['supplier'] = $model2->findAll();
            $data['detail'] = $cekData;
            
            return view('pembelian/editpembelian', $data);
        }else{
            $pesan = [
                'error' => '<div class ="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden"true">x</button> <h5><i class="icon fas fa-ban"></i> Error !</h5>Data tidak ditemukan...</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/pembelian/index');
        }
    }

    public function updatedata()
    {
        $beli_kode = $this->request->getVar('beli_kode');
        $beli_tanggal = $this->request->getVar('beli_tanggal');
        $beli_supplier = $this->request->getVar('beli_supplier');
        $beli_produk = $this->request->getVar('beli_produk');
        $beli_detail_ekor = $this->request->getVar('beli_detail_ekor');
        $beli_detail_kg = $this->request->getVar('beli_detail_kg');

        $beli_ekor = $this->request->getVar('beli_ekor');
        $beli_ekor_sekarang = $this->request->getVar('beli_ekor_sekarang');
        
        $beli_kg = $this->request->getVar('beli_kg');
        $beli_kg_sekarang = $this->request->getVar('beli_kg_sekarang');

        $beli_harga = $this->request->getVar('beli_harga');
        $beli_totalHarga = $this->request->getVar('beli_totalHarga');
        $beli_bukti = $this->request->getFile('beli_bukti');

        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'beli_tanggal' => [
                'rules' => 'required',
                'label' => 'Tanggal Pembelian',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'beli_supplier' => [
                'rules' => 'required',
                'label' => 'Nama Supplier',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'beli_produk' => [
                'rules' => 'required',
                'label' => 'Produk',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'beli_detail_ekor' => [
                'rules' => 'required',
                'label' => 'Detail Ekor',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'beli_detail_kg' => [
                'rules' => 'required',
                'label' => 'Detail Kg',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'beli_ekor' => [
                'rules' => 'required',
                'label' => 'Ekor',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'beli_kg' => [
                'rules' => 'required',
                'label' => 'Kg',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'beli_harga' => [
                'rules' => 'required',
                'label' => 'Harga Satuan',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'beli_totalHarga' => [
                'rules' => 'required',
                'label' => 'Total Harga',
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
            return redirect()->to('/pembelian/edit');
        }else {       
            // upload file     
            $file = $this->request->getFile('beli_bukti');
            if($file==""){
                $namaFile = "";
            }else{
                if ($file->isValid() && !$file->hasMoved())
                {
                    $newName = $beli_kode;
                    $extension = $file->getExtension();
                    $namaFile = $newName . '.' . $extension;
                    $file->move(ROOTPATH . 'public/bukti_beli', $namaFile,true);
                }
                else
                {
                    $pesan = [
                        'sukses' => '<div class ="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>Bukti pembelian tidak dapat diunggah!</div>'
                    ];
        
                    session()->setFlashdata($pesan);
                    return redirect()->to('/pembelian/index');
                }
            }

            // pisah $beli_produk
            $prd = explode("#", $beli_produk);
            $kodeprd = trim($prd[0]);
            $namaprd = trim($prd[1]);
            
            // update data di 'pembelian'
            $model0 = new Model_pembelian();
            $model0->where('kode_pembelian', $beli_kode);

            $data = [
                'tanggal_pembelian' => $beli_tanggal,
                'supplier' => $beli_supplier,
                'kode_produk_dibeli' => $kodeprd,
                'produk_dibeli' => $namaprd,
                'detail_ekor' => $beli_detail_ekor,
                'detail_kg' => $beli_detail_kg,
                'jml_ekor' => $beli_ekor,
                'jml_kg' => $beli_kg,
                'harga' => $beli_harga,
                'harga_total' => $beli_totalHarga
            ];

            if($namaFile !== "")
            {
                $data = [
                    'bukti' => $namaFile
                ];
            }

            $model0->update(['kode_pembelian' => $beli_kode],$data);

            // update data stok di 'produk'
            $model1 = new Model_produk();
            $data1 = [
                'stok_perkg' => $beli_kg_sekarang,
                'stok_perekor' => $beli_ekor_sekarang
            ];
            $model1->update(['kode_produk' => $kodeprd],$data1);

            // pesan
            $pesan = [
                'sukses' => '<div class ="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>Data transaksi dengan kode <strong>'.$beli_kode.' </strong> berhasil disimpan...</div><script>localStorage.setItem("dataBeli",0)</script>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/pembelian/index');
        }
    }
}