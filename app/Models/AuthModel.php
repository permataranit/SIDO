<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    public function authDosen($uname)
    {

        $query = $this->db->query("SELECT nip, password, nama, hak_akses FROM dosen WHERE nip ='$uname' LIMIT 1");

        return $query;
    }

    public function authMahasiswa($uname)
    {
        $query = $this->db->query("SELECT nim, password, nama FROM mahasiswa WHERE nim ='$uname' LIMIT 1");

        return $query;
    }

    public function authAdmin($uname)
    {
        $query = $this->db->query("SELECT id_admin, password, nama FROM admin WHERE username ='$uname' LIMIT 1");

        return $query;
    }
}
