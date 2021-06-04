<?php

namespace App\Models;

use CodeIgniter\Model;

class PenelitianModel extends Model
{
    protected $table = 'penelitian';
    protected $primaryKey = 'id_penelitian';
    protected $allowedFields = ['id_penelitian', 'nip', 'judul', 'skim', 'tgl_mulai', 'tgl_selesai', 'sumber_dana', 'output'];
    protected $useTimestamps = false;

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function getPenelitian($nip, $id = FALSE)
    {

        if ($id == false) {
            return $this->where(['nip' => $nip])->findAll();
        }

        return $this->where(['id_penelitian' => $id])->first();
    }
}
