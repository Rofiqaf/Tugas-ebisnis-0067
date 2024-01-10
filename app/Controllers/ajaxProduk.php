<?php
namespace App\Controllers;

use App\Models\Model_produkajax;

class ajaxProduk extends BaseController {
   public function index() {
      $model = new Model_produkajax();
      $data['json_data'] = $model->getDataFromDatabase();

      return view('your_view', $data);
   }
}