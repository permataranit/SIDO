<?php

namespace App\Models;

use CodeIgniter\Model;

class PengabdianModel extends Model
{
    protected $table = 'pengabdian';
    protected $primaryKey = 'id_pengabdian';
    protected $allowedFields = ['id_pengabdian', 'nip', 'judul', 'skim', 'tgl_mulai', 'tgl_selesai', 'sumber_dana'];
    protected $useTimestamps = false;

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function getPengabdian($nip, $id = FALSE)
    {

        if ($id == false) {
            return $this->where(['nip' => $nip])->findAll();
        }

        return $this->where(['id_pengabdian' => $id])->first();
    }
}
