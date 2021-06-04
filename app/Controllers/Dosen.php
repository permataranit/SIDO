<?php

namespace App\Controllers;

use App\Models\DosenModel;

class Dosen extends BaseController
{
    protected $dosenModel;
    protected $id_nip;

    public function __construct()
    {
        $this->dosenModel = new DosenModel();
        $this->id_nip = session()->get('ses_id');
    }

    public function index()
    {
        //Cara konek ke db tanpa model
        /*
            $db = \Config\Database::connect();
            $penelitian = $db->query("SELECT * FROM penelitian");
            foreach ($penelitian->getResultArray() as $row) {
                d($row);
            }
            tp bawah ini harusnya bukan getDosen tapi findAll
        */

        //Cara pakai model
        $dosen = $this->dosenModel->getDosen();

        $data = [
            'title' => 'Daftar Dosen',
            'dosen' => $dosen
        ];

        return view('dosen/index', $data);
    }

    //--------------------------------------------------------------------

    public function detail($nip)
    {
        $dosen = $this->dosenModel->getDosen($nip);

        $sama = FALSE;
        if ($this->id_nip == $nip) {
            $sama = TRUE;
        }

        $data = [
            'title' => 'Profil Dosen',
            'dosen' => $dosen,
            'sama' => $sama
        ];

        //jiks dosen tidak ada
        if (empty($data['dosen'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Dosen tidak ada dalam database');
        }

        return view('dosen/profil', $data);
    }

    //--------------------------------------------------------------------

    public function create()
    {
        //di validasi harus nyalain session();
        $data = [
            'title' => 'Form Tambah Dosen',
            'validation' => \Config\Services::validation()
        ];

        return view('dosen/create', $data);
    }

    //--------------------------------------------------------------------

    public function save()
    {
        //validasi input
        if (!$this->validate([
            'nip' => [
                'rules' => 'required|is_unique[dosen.nip]',
                'errors' => [
                    'required' => 'NIP dosen harus diisi',
                    'is_unique' => 'NIP dosen sudah ada'
                ]
            ],
            'email' => [
                'rules' => 'required|is_unique[dosen.email]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah ada'
                ]
            ],
            'nidn' => [
                'rules' => 'required|is_unique[dosen.nidn]',
                'errors' => [
                    'required' => 'NIDN dosen harus diisi',
                    'is_unique' => 'NIDN dosen sudah ada'
                ]
            ],
            'scopus_id' => [
                'rules' => 'required|is_unique[dosen.scopus_id]',
                'errors' => [
                    'required' => 'Scopus ID dosen harus diisi',
                    'is_unique' => 'Scopus ID dosen sudah ada'
                ]
            ]
        ])) {
            //$validation = \Config\Services::validation();
            // return redirect()->to('/dosen/create')->withInput()->with('validation', $validation);
            return redirect()->to('/admin/dosen/create')->withInput();
        }

        //$this->request->getVar() untuk mengambil data yang dikirim
        //kalo getVar itu bisa methode apa aja
        //kalo getPost khusus data yang dikirim lewat Post
        //getGet juga untuk data yang dikirim lewat Get
        //you must using insert cuz save method wont work
        try {
            $this->dosenModel->insert([
                'nip' => $this->request->getVar('nip'),
                'nidn' => $this->request->getVar('nidn'),
                'nama' => $this->request->getVar('nama'),
                'tempat_lahir' => $this->request->getVar('tempat_lahir'),
                'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
                'alamat_rumah' => $this->request->getVar('address'),
                'email' => $this->request->getVar('email'),
                'scopus_id' => $this->request->getVar('scopus_id'),
                'no_hp' => $this->request->getVar('no_hp')
            ]);

            session()->setFlashdata('pesan', 'Dosen berhasil ditambahkan.');
        } catch (\Exception $e) {
            // die($e->getMessage());
            session()->setFlashdata('error', $e->getMessage());
        }

        return redirect()->to('/admin/dosen');
    }

    //--------------------------------------------------------------------

    public function delete($nip)
    {
        try {
            $this->dosenModel->delete($nip);
            session()->setFlashdata('pesan', 'Dosen berhasil dihapus.');
        } catch (\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
        }

        return redirect()->to('/admin/dosen');
    }

    //--------------------------------------------------------------------

    public function edit($nip)
    {
        $sama = FALSE;
        if ($this->id_nip == $nip) {
            $sama = TRUE;
        }
        //di validasi harus nyalain session();
        $data = [
            'title' => 'Form Ubah Dosen',
            'validation' => \Config\Services::validation(),
            'dosen' => $this->dosenModel->getDosen($nip),
            'sama' => $sama
        ];

        return view('dosen/edit', $data);
    }

    //--------------------------------------------------------------------

    public function update($nip)
    {
        if ($this->id_nip == $nip) {
            $action1 = "/dosen/profile/edit/" . $nip;
            $action2 = "/dosen/profile/" . $nip;
        } else {
            $action1 = "/admin/dosen/edit/" . $nip;
            $action2 = "/admin/dosen/";
        }
        //cek apakah data sama dengan yang lama
        $dosenLama = $this->dosenModel->getDosen($nip);
        $cekData = ['email', 'nidn', 'scopus_id'];
        $validasi = [];

        foreach ($cekData as $cek) {
            if ($dosenLama[$cek] == $this->request->getVar($cek)) {
                $rules = 'required';
            } else {
                $rules = 'required|is_unique[dosen.' . $cek . ']';
            }

            $validasi[$cek] = [
                'rules' => $rules,
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah ada'
                ]
            ];
        }

        //validasi input
        if (!$this->validate($validasi)) {
            return redirect()->to($action1)->withInput();
        }

        try {
            $this->dosenModel->update($nip, [
                'nidn' => $this->request->getVar('nidn'),
                'nama' => $this->request->getVar('nama'),
                'tempat_lahir' => $this->request->getVar('tempat_lahir'),
                'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
                'alamat_rumah' => $this->request->getVar('address'),
                'email' => $this->request->getVar('email'),
                'scopus_id' => $this->request->getVar('scopus_id'),
                'no_hp' => $this->request->getVar('no_hp')
            ]);

            session()->setFlashdata('pesan', 'Profil berhasil diubah.');
        } catch (\Exception $e) {
            // die($e->getMessage());
            session()->setFlashdata('error', $e->getMessage());
        }

        return redirect()->to($action2);
    }
    //--------------------------------------------------------------------

    public function show_list()
    {
        $dosen = $this->dosenModel->getDosen();

        $data = [
            'title' => 'Daftar Dosen Statistika UNDIP',
            'list_dosen' => $dosen
        ];

        return view('dosen/list_dosen', $data);
    }

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
        $user = $this->dosenModel->where(['nip' => $id])->first();
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
            return redirect()->to('/dosen/password')->withInput();
        }

        $data = [
            'password' => $this->request->getVar('baru')
        ];
        // dd($data);

        try {
            $this->dosenModel->set($data)->update($id);
            // $this->dosenModel->update($id, $data);
            session()->setFlashdata('pesan', 'Password berhasil diubah.');
        } catch (\Exception $e) {
            // die($e->getMessage());
            session()->setFlashdata('error', $e->getMessage());
        }

        return redirect()->to('/dosen/password');
    }

    //--------------------------------------------------------------------
}
