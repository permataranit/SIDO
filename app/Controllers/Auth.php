<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->authModel = new AuthModel();
    }

    public function index()
    {
        return view('home');
    }

    public function auth()
    {
        //validasi input
        if (!$this->validate([
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username harus diisi'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password harus diisi'
                ]
            ]
        ])) {
            return redirect()->to('/')->withInput();
        }

        $username = htmlspecialchars($this->request->getPost('username'), ENT_QUOTES);
        $password = htmlspecialchars($this->request->getPost('password'), ENT_QUOTES);

        $cek_dosen = $this->authModel->authDosen($username);

        if ($cek_dosen->resultID->num_rows > 0) { //jika login sebagai dosen

            //retrieving data dosen
            $data = $cek_dosen->getRowArray();

            if ($data['password'] == $password) { //cek password

                //set session masuk = TRUE
                session()->set('masuk', TRUE);

                if ($data['hak_akses'] == '1') { //If Kadep
                    session()->set('akses', '1');
                    session()->set('ses_id', $data['nip']);
                    session()->set('ses_nama', $data['nama']);
                    session()->setFlashdata('halo', 'Selamat Datang!<br>');
                    return redirect()->to('/kadep');
                } else { //else dosen
                    session()->set('akses', '2');
                    session()->set('ses_id', $data['nip']);
                    session()->set('ses_nama', $data['nama']);
                    session()->setFlashdata('halo', 'Selamat Datang! ');
                    return redirect()->to('/dosen/bulan');
                }
            } else {
                session()->setFlashdata('error', 'Password yang Anda masukkan salah!');
                return redirect()->to('/');
            }
        } else { //jika login sebagai admin

            $cek_admin = $this->authModel->authAdmin($username);


            if ($cek_admin->resultID->num_rows > 0) {

                //retrieving data admin
                $data = $cek_admin->getRowArray();

                if ($data['password'] == $password) { //cek password

                    session()->set('masuk', TRUE);
                    session()->set('akses', '4');
                    session()->set('ses_id', $data['id_admin']);
                    session()->set('ses_nama', $data['nama']);
                    session()->setFlashdata('halo', 'Selamat Datang! ');
                    return redirect()->to('/admin/dosen');
                } else {
                    session()->setFlashdata('error', 'Password yang Anda masukkan salah!');
                    return redirect()->to('/');
                }
            } else {  //jika login sebagai mahasiswa

                $cek_mahasiswa = $this->authModel->authMahasiswa($username);

                if ($cek_mahasiswa->resultID->num_rows > 0) {

                    //retrieving data mahasiswa
                    $data = $cek_mahasiswa->getRowArray();

                    if ($data['password'] == $password) { //cek password

                        session()->set('masuk', TRUE);
                        session()->set('akses', '3');
                        session()->set('ses_id', $data['nim']);
                        session()->set('ses_nama', $data['nama']);
                        session()->setFlashdata('halo', 'Selamat Datang! ');
                        return redirect()->to('/mahasiswa');
                    } else {
                        session()->setFlashdata('error', 'Password yang Anda masukkan salah!');
                        return redirect()->to('/');
                    }
                } else {  // username not found

                    session()->setFlashdata('error', 'NIP/NIM tidak terdaftar! Harap hubungi admin/pihak yang bersangkutan');
                    return redirect()->to('/');
                }
            }
        }
    }

    public function logout()
    {
        $array_items = ['masuk', 'akses', 'ses_id', 'ses_nama'];
        session()->remove($array_items);
        return redirect()->to('/');
    }

    public function blocked()
    {
        echo "access denied";
    }
}
