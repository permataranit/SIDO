<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';
    protected $allowedFields = ['nama', 'username', 'password', 'email', 'no_telp'];
    protected $useTimestamps = false;

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;
}
