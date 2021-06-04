<?php

namespace App\Controllers;

use App\Models\PenelitianModel;

class Penelitian extends BaseController
{
    protected $penelitianModel;
    protected $nip;
    protected $validasi = [
        'judul' => [
            'rules' => 'required',
            'errors' => [
                'required' => '{field} penelitian harus diisi'
            ]
        ],
        'skim' => [
            'rules' => 'required',
            'errors' => [
                'required' => '{field} penelitian harus diisi'
            ]
        ],
        'tgl_mulai' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'tanggal mulai penelitian harus diisi'
            ]
        ],
        'sumber_dana' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'sumber dana penelitian harus diisi'
            ]
        ]
    ];

    public function __construct()
    {
        $this->nip = session()->get('ses_id');
        $this->penelitianModel = new PenelitianModel();
    }

    public function index()
    {
        $penelitian = $this->penelitianModel->getPenelitian($this->nip);

        $data = [
            'title' => 'Daftar Penelitian',
            'penelitian' => $penelitian
        ];

        return view('penelitian/index', $data);
    }

    //--------------------------------------------------------------------

    public function detail($id)
    {

        $penelitian = $this->penelitianModel->getPenelitian($this->nip, $id);

        $data = [
            'title' => 'Detail Penelitian',
            'penelitian' => $penelitian
        ];


        //jiks dosen tidak ada
        if (empty($data['penelitian'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Penelitian tidak ada dalam database');
        }

        return view('penelitian/detail', $data);
    }

    //--------------------------------------------------------------------

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Penelitian',
            'validation' => \Config\Services::validation()
        ];

        return view('penelitian/create', $data);
    }

    //--------------------------------------------------------------------

    public function save()
    {
        helper(['kode_helper']);
        $id_penelitian = kodeauto("penelitian", "id_penelitian", "B");

        //validasi input
        if (!$this->validate($this->validasi)) {
            return redirect()->to('/dosen/penelitian/create')->withInput();
        }

        try {
            $this->penelitianModel->insert([
                'id_penelitian' => $id_penelitian,
                'nip' => $this->nip,
                'judul' => $this->request->getVar('judul'),
                'skim' => $this->request->getVar('skim'),
                'tgl_mulai' => $this->request->getVar('tgl_mulai'),
                'sumber_dana' => $this->request->getVar('sumber_dana')
            ]);

            session()->setFlashdata('pesan', 'Penelitian berhasil ditambahkan.');
        } catch (\Exception $e) {
            // die($e->getMessage());
            session()->setFlashdata('error', $e->getMessage());
        }

        return redirect()->to('/dosen/penelitian');
    }

    //--------------------------------------------------------------------

    public function delete($id)
    {
        try {
            $this->penelitianModel->delete($id);
            session()->setFlashdata('pesan', 'Penelitian berhasil dihapus.');
        } catch (\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
        }

        return redirect()->to('/dosen/penelitian');
    }

    //--------------------------------------------------------------------

    public function edit($id)
    {
        //di validasi harus nyalain session();
        $data = [
            'title' => 'Form Edit Penelitian',
            'validation' => \Config\Services::validation(),
            'penelitian' => $this->penelitianModel->getPenelitian($this->nip, $id)
        ];

        return view('penelitian/edit', $data);
    }

    //--------------------------------------------------------------------

    public function update($id)
    {
        //validasi input
        if (!$this->validate($this->validasi)) {
            return redirect()->to('/dosen/penelitian/edit/' . $id)->withInput();
        }

        try {
            $this->penelitianModel->update($id, [
                'judul' => $this->request->getVar('judul'),
                'skim' => $this->request->getVar('skim'),
                'tgl_mulai' => $this->request->getVar('tgl_mulai'),
                'tgl_selesai' => $this->request->getVar('tgl_selesai'),
                'sumber_dana' => $this->request->getVar('sumber_dana')
            ]);

            session()->setFlashdata('pesan', 'Penelitian berhasil diubah.');
        } catch (\Exception $e) {
            // die($e->getMessage());
            session()->setFlashdata('error', $e->getMessage());
        }

        return redirect()->to('/dosen/penelitian');
    }
}
