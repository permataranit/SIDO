<?php

namespace App\Models;

use CodeIgniter\Model;

class DosenModel extends Model
{
    protected $table = 'dosen';
    protected $primaryKey = 'nip';
    protected $allowedFields = ['nip', 'nidn', 'nama', 'tempat_lahir', 'tanggal_lahir', 'alamat_rumah', 'email', 'scopus_id', 'no_hp'];
    protected $useTimestamps = false;

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function getDosen($nip = false)
    {

        if ($nip == false) {
            return $this->findAll();
        }

        return $this->where(['nip' => $nip])->first();
    }
}
