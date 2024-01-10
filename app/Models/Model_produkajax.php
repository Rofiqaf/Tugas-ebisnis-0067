<?php
namespace App\Models;

use CodeIgniter\Model;

class Model_produkajax extends Model {
   protected $table = 'produk';
   protected $primaryKey = 'kode_produk';

   public function getDataFromDatabase() {
      return $this->findAll();
   }
}