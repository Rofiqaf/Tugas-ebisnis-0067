<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_userlevel extends Model
{
    protected $table            = 'levels';
    protected $primaryKey       = 'kode_levels';
    protected $allowedFields    = [
        'nama_levels'
    ];
}