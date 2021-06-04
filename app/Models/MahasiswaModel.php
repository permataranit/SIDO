<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'nim';
    protected $allowedFields = ['nim', 'nama', 'password', 'email', 'alamat', 'no_telp'];
    protected $useTimestamps = false;

    private $_client; //_ used when defining the private member variable for a public property.

    public function getAPIMahasiswa()
    {
        $options = [
            'baseURI' => 'http://localhost/MahasiswaREST/RestServer/api/',
            'auth' => ['admin', '1234']
        ];

        $this->_client = \Config\Services::curlrequest($options);

        $response = $this->_client->request('GET', 'mahasiswa', [
            'query' => [
                'X-API-KEY' => 'wpu123'
            ]
        ]);

        $result = json_decode($response->getBody(), true); //true for an array return
        return $result['data'];
        die();
    }

    public function getMahasiswa($nim = false)
    {

        if ($nim == false) {
            return $this->findAll();
        }

        return $this->where(['nim' => $nim])->first();
    }
}
