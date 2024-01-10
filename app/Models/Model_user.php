<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_user extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'kode_user';
    protected $allowedFields    = [
        'kode_user','username','password', 'nama', 'level'
    ];
    public function getMaxKodeUser()
    {
        $query = $this->selectMax('kode_user')->get();
        return $query->getRow()->kode_user;
    }
}