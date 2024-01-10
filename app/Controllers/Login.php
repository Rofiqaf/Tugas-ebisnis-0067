<?php

namespace App\Controllers;
use App\Models\AuthModel;

class Login extends BaseController
{
    public function index()
    {
        // Memuat library session
        $session = session();

        // Memeriksa apakah pengguna sudah login
        if ($session->has('user')) {
            // Jika sudah login, alihkan ke halaman dashboard atau halaman yang sesuai
            return redirect()->to('/dashboard');
            //echo "masih ada sesi";
        }

        // Jika belum login, tampilkan halaman login
        return view('login/index');
    }

    public function processLogin()
    {
        // Mendapatkan input dari formulir login
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Memeriksa kredensial pengguna
        $authModel = new AuthModel();
        $userInfo = $authModel->checkCredentials($username, $password);

        $session = session();

        if ($userInfo) {    
            $session->set('user', $userInfo);
            return redirect()->to('/dashboard');
            // berhasil login
        } else {
            // Jika kredensial salah, kembalikan ke halaman login dengan pesan error
            $session->setFlashdata('error', 'Username atau password salah. Periksa kembali.');
            return redirect()->to('/');
        }
    }

    public function logout()
    {
        // Memuat library session
        $session = session();

        // Menghapus semua data sesi
        $session->destroy();

        // Alihkan ke halaman login atau halaman lain yang sesuai
        return redirect()->to('/');
    }
}
