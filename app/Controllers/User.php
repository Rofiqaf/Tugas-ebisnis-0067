<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Model_user;
use App\Models\Model_userlevel;

class User extends BaseController
{
    public $user = '';
    public function __construct()
    {
        $this->user = new Model_user();
    }

    public function index()
    {
        // Mengambil semua data pembelian
        $model = new Model_user();

        // Mengambil semua data dari tabel
        $data['datauser'] = $model->findAll();
        $data['totaldata'] = $model->countAll();

        // Menampilkan view dengan data
        return view('user/index', $data);
    }

    public function tambah()
    {
        $model = new Model_user();
        $model2 = new Model_userlevel();
        $data['max_kode_user'] = $model->getMaxKodeUser();
        $data['userlevel'] = $model2->findAll();
        

        return view('user/tambah', $data);
    }

    public function simpandata()
    {
        $user_kode = $this->request->getVar('user_kode');
        $user_username = $this->request->getVar('user_username');
        $user_password = $this->request->getVar('user_password');
        $user_nama = $this->request->getVar('user_nama');
        $user_level = $this->request->getVar('user_level');

        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'user_kode' => [
                'rules' => 'required',
                'label' => 'Kode Pembelian',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'user_username' => [
                'rules' => 'required|is_unique[users.username]',
                'label' => 'Username',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada, coba yang lain'
                ]
            ],
            'user_password' => [
                'rules' => 'required',
                'label' => 'Password',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'user_nama' => [
                'rules' => 'required',
                'label' => 'Nama Pengguna',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'user_level' => [
                'rules' => 'required',
                'label' => 'User Level',
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
            return redirect()->to('/user/tambah');
        }else {
            $this->user->insert([
                'kode_user' => $user_kode, 'username' => $user_username, 'password' => $user_password, 'nama' => $user_nama, 'level' => $user_level
            ]);

            $pesan = [
                'sukses' => '<div class ="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>Data dengan username <strong>'.$user_username.' </strong> berhasil disimpan...</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/user/index');
        }
    }

    public function hapus(...$kode0)
    {
        $kode = implode('/', $kode0);

        $cekData = $this->user->find($kode);

        if ($cekData) {

            $this->user->delete($kode);
            $pesan = [
                'sukses' => '<div class ="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden"true">x</button>Pengguna berhasil dihapus...</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/user/index');

        }else{
            $pesan = [
                'error' => '<div class ="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden"true">x</button> <h5><i class="icon fas fa-ban"></i> Error !</h5>Terjadi kesalahan. Ulangi sekali lagi ...</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/user/index');
        }
    }

    public function edit(...$kode0)
    {
        $kode = implode('/', $kode0);
        
        $cekData = $this->user->find($kode);

        if ($cekData) {
            
            $model = new Model_user();
            $model2 = new Model_userlevel();
            $data['detail'] = $model->find($kode);
            $data['userlevel'] = $model2->findAll();
            return view('user/edituser', $data);
        }else{
            $pesan = [
                'error' => '<div class ="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden"true">x</button> <h5><i class="icon fas fa-ban"></i> Error !</h5>Terjadi kesalahan. Ulangi sekali lagi ...</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/user/index');
        }
    }
    public function updatedata()
    {
        $user_kode = $this->request->getVar('user_kode');
        $user_username = $this->request->getVar('user_username');
        $user_password = $this->request->getVar('user_password');
        $user_nama = $this->request->getVar('user_nama');
        $user_level = $this->request->getVar('user_level');

        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'user_kode' => [
                'rules' => 'required',
                'label' => 'Kode Pembelian',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'user_username' => [
                'rules' => 'required',
                'label' => 'Username',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            'user_password' => [
                'rules' => 'required',
                'label' => 'Password',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'user_nama' => [
                'rules' => 'required',
                'label' => 'Nama Pengguna',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'user_level' => [
                'rules' => 'required',
                'label' => 'User Level',
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
            return redirect()->to('/user/edit');
        }else {
            $model = new Model_user();
            $model->where('kode_user', $user_kode);
            $data = [
                'username' => $user_username,
                'password' => $user_password,
                'nama' => $user_nama,
                'level' => $user_level,
            ];
            $model->set($data)->update();

            $pesan = [
                'sukses' => '<div class ="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>Data dengan username <strong>'.$user_username.' </strong> berhasil diubah...</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/user/index');
        }
    }
}