<?php

namespace App\Controllers;
define('_TITLE', 'Beranda');

use App\Controllers\BaseController;
use App\Models\Model_pembelian;
use App\Models\Model_penjualan;
use App\Models\Model_produk;

class Main extends BaseController
{
    public function index()
    {
        return view('main/layout');
    }
    public function dashboard()
    {
        // Memuat library session
        $session = session();

        // Memeriksa apakah pengguna sudah login
        if ($session->has('user')) {
            // Jika sudah login, tetap di dashboard
        }else{
            // jika belum login dialihkan ke login
            return redirect()->to('/');
        }
        $data = [
            'title' => _TITLE
        ];

        $model0 = new Model_produk();
        $data['list_produk'] = $model0->findAll();
        $model1 = new Model_penjualan();
        $data['grafik_data_penjualan'] = $model1->getGrafikData();

        $totalJ1 = $model1->getTotalJ(1);
        $totalJ2 = $model1->getTotalJ(2);
        $totalJ3 = $model1->getTotalJ(3);
        $totalJ4 = $model1->getTotalJ(4);
        $totalJ5 = $model1->getTotalJ(5);
        $totalJ6 = $model1->getTotalJ(6);
        $totalJ7 = $model1->getTotalJ(7);
        $totalJ8 = $model1->getTotalJ(8);
        $totalJ9 = $model1->getTotalJ(9);
        $totalJ10 = $model1->getTotalJ(10);
        $totalJ11 = $model1->getTotalJ(11);
        $totalJ12 = $model1->getTotalJ(12);

        $data['totalJ1'] = $totalJ1;
        $data['totalJ2'] = $totalJ2;
        $data['totalJ3'] = $totalJ3;
        $data['totalJ4'] = $totalJ4;
        $data['totalJ5'] = $totalJ5;
        $data['totalJ6'] = $totalJ6;
        $data['totalJ7'] = $totalJ7;
        $data['totalJ8'] = $totalJ8;
        $data['totalJ9'] = $totalJ9;
        $data['totalJ10'] = $totalJ10;
        $data['totalJ11'] = $totalJ11;
        $data['totalJ12'] = $totalJ12;

        $model2 = new Model_pembelian();
        $data['grafik_data_pembelian'] = $model2->getGrafikData();

        $totalHarga1 = $model2->getTotalB(1);
        $totalHarga2 = $model2->getTotalB(2);
        $totalHarga3 = $model2->getTotalB(3);
        $totalHarga4 = $model2->getTotalB(4);
        $totalHarga5 = $model2->getTotalB(5);
        $totalHarga6 = $model2->getTotalB(6);
        $totalHarga7 = $model2->getTotalB(7);
        $totalHarga8 = $model2->getTotalB(8);
        $totalHarga9 = $model2->getTotalB(9);
        $totalHarga10 = $model2->getTotalB(10);
        $totalHarga11 = $model2->getTotalB(11);
        $totalHarga12 = $model2->getTotalB(12);

        $data['totalB1'] = $totalHarga1;
        $data['totalB2'] = $totalHarga2;
        $data['totalB3'] = $totalHarga3;
        $data['totalB4'] = $totalHarga4;
        $data['totalB5'] = $totalHarga5;
        $data['totalB6'] = $totalHarga6;
        $data['totalB7'] = $totalHarga7;
        $data['totalB8'] = $totalHarga8;
        $data['totalB9'] = $totalHarga9;
        $data['totalB10'] = $totalHarga10;
        $data['totalB11'] = $totalHarga11;
        $data['totalB12'] = $totalHarga12;

        return view('main/dashboard', $data);
    }
}