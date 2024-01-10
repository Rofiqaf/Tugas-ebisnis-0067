<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'kode_user';
    protected $allowedFields = ['username', 'password', 'nama', 'level'];

    public function checkCredentials($username, $password)
    {
        $user = null;
        $user = $this->where('username', $username)->first();

        //if ($user && password_verify($password, $user['password'])) {
        if ($user && $user['password'] === $password) {
            $userInfo = [
                'username' => $user['username'],
                'nama'     => $user['nama'],
                'level'     => $user['level'],
            ];

            return $userInfo;
        }    

        return false;
    }
}
