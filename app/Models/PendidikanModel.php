<?php

namespace App\Models;

use CodeIgniter\Model;

class PendidikanModel extends Model
{
    protected $table = 'pendidikan';
    protected $primaryKey = 'id_pendidikan';
    protected $allowedFields = ['id_pengabdian', 'kategori'];
    protected $useTimestamps = false;

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function getPendidikan()
    {
        return $this->findAll();
    }
}
