<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table = 'jadwal';
    protected $primaryKey = 'id_jadwal';
    protected $allowedFields = ['id_jadwal', 'nip', 'nama_acara', 'tanggal', 'waktu', 'tempat', 'id_pendidikan', 'id_penelitian', 'id_pengabdian', 'keterangan'];
    protected $useTimestamps = false;

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;


}
