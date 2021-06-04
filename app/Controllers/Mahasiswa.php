<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;

class Mahasiswa extends BaseController
{
    protected $mhsModel;

    public function __construct()
    {
        $this->mhsModel = new MahasiswaModel();
    }

    public function index()
    {
        //echo " Sudah di controller mahasiswa nih! ";
        $mahasiswa = $this->mhsModel->getMahasiswa();

        $data = [
            'title' => 'Daftar Mahasiswa',
            'mahasiswa' => $mahasiswa
        ];

        return view('mahasiswa/index', $data);
    }

    //--------------------------------------------------------------------

    public function detail($nim)
    {
        $mahasiswa = $this->mhsModel->getMahasiswa($nim);

        $data = [
            'title' => 'Profil Mahasiswa',
            'mahasiswa' => $mahasiswa
        ];

        //jiks dosen tidak ada
        if (empty($data['mahasiswa'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Mahasiswa tidak ada dalam database');
        }

        return view('mahasiswa/profil', $data);
    }

    //--------------------------------------------------------------------

    public function syncMhs()
    {
        $mahasiswaAPI = $this->mhsModel->getAPIMahasiswa();
        $mahasiswa = $this->mhsModel->getMahasiswa();

        //dd($mahasiswaAPI);

        if (sizeof($mahasiswaAPI) == sizeof($mahasiswa)) {
            session()->setFlashdata('info', 'Data mahasiswa sudah yang paling baru.');
            return redirect()->to('/admin/mahasiswa');
        } else {
            $mhsAPI = array_column($mahasiswaAPI, 'nim'); //hanya ambil nim
            $mhs = array_column($mahasiswa, 'nim');

            foreach ($mhsAPI as $search_item) {
                if (!in_array($search_item, $mhs)) {
                    //mencari urutan berapa
                    $key = array_search($search_item, array_column($mahasiswaAPI, 'nim'));

                    //dd($mahasiswaAPI[$key]);

                    try {
                        $this->mhsModel->insert([
                            'nim' => $mahasiswaAPI[$key]['nim'],
                            'nama' => $mahasiswaAPI[$key]['nama'],
                            'password' => $mahasiswaAPI[$key]['nim'],
                            'email' => $mahasiswaAPI[$key]['email'],
                            'no_telp' => $mahasiswaAPI[$key]['no_telp'],
                            'alamat' => $mahasiswaAPI[$key]['alamat']
                        ]);
                    } catch (\Exception $e) {
                        session()->setFlashdata('error', $e->getMessage());
                        return redirect()->to('/admin/mahasiswa');
                    }
                }
            }
            session()->setFlashdata('pesan', 'Data mahasiswa berhasil disinkronkan.');
            return redirect()->to('/admin/mahasiswa');
        } //end of else
    }

    //--------------------------------------------------------------------

    //--------------------------------------------------------------------

    public function indexPass()
    {
        //di validasi harus nyalain session();
        $data = [
            'title' => 'Form Ubah Password',
            'validation' => \Config\Services::validation()
        ];

        return view('password/editPassword', $data);
    }

    //--------------------------------------------------------------------

    public function gantiPass()
    {
        $id = session()->get('ses_id');
        $user = $this->mhsModel->where(['nim' => $id])->first();
        $password = $user['password'];

        //validasi input
        if (!$this->validate([
            'lama' => [
                'rules' => 'required|password_check[lama,' . $password . ']',
                'errors' => [
                    'required' => 'Password lama harus diisi',
                    'password_check' => 'Password lama salah, masukkan password yang benar'
                ]
            ],
            'baru' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password baru harus diisi'
                    // 'matches' => 'Password baru sama dengan yang lama'
                ]
            ],
            'ulang' => [
                'rules' => 'required|matches[baru]',
                'errors' => [
                    'required' => 'Ulang kembali password baru',
                    'matches' => 'Mohon masukkan password yang baru dengan benar sekali lagi'
                ]
            ]
        ])) {
            //$validation = \Config\Services::validation();
            // return redirect()->to('/dosen/create')->withInput()->with('validation', $validation);
            return redirect()->to('/mahasiswa/password')->withInput();
        }

        try {
            $this->mhsModel->update($id, [
                'password' => $this->request->getVar('baru')
            ]);
            session()->setFlashdata('pesan', 'Password berhasil diubah.');
        } catch (\Exception $e) {
            // die($e->getMessage());
            session()->setFlashdata('error', $e->getMessage());
        }

        return redirect()->to('/mahasiswa/password');
    }

    //--------------------------------------------------------------------
}
