<?php

namespace App\Controllers;

use App\Models\PengabdianModel;

class Pengabdian extends BaseController
{
    protected $pengabdianModel;
    protected $nip;
    protected $validasi = [
        'judul' => [
            'rules' => 'required',
            'errors' => [
                'required' => '{field} pengabdian harus diisi'
            ]
        ],
        'skim' => [
            'rules' => 'required',
            'errors' => [
                'required' => '{field} pengabdian harus diisi'
            ]
        ],
        'tgl_mulai' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'tanggal mulai pengabdian harus diisi'
            ]
        ],
        'sumber_dana' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'sumber dana pengabdian harus diisi'
            ]
        ]
    ];

    public function __construct()
    {
        $this->nip = session()->get('ses_id');
        $this->pengabdianModel = new PengabdianModel();
    }

    public function index()
    {
        $pengabdian = $this->pengabdianModel->getPengabdian($this->nip);

        $data = [
            'title' => 'Daftar Pengabdian',
            'pengabdian' => $pengabdian
        ];

        return view('pengabdian/index', $data);
    }

    //--------------------------------------------------------------------

    public function detail($id)
    {
        $pengabdian = $this->pengabdianModel->getPengabdian($this->nip, $id);

        $data = [
            'title' => 'Detail Pengabdian',
            'pengabdian' => $pengabdian
        ];


        //jiks dosen tidak ada
        if (empty($data['pengabdian'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pengabdian tidak ada dalam database');
        }

        return view('pengabdian/detail', $data);
    }

    //--------------------------------------------------------------------

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Pengabdian',
            'validation' => \Config\Services::validation()
        ];

        return view('pengabdian/create', $data);
    }

    //--------------------------------------------------------------------

    public function save()
    {
        helper(['kode_helper']);
        $id_pengabdian = kodeauto("pengabdian", "id_pengabdian", "C");

        //validasi input
        if (!$this->validate($this->validasi)) {
            return redirect()->to('/dosen/pengabdian/create')->withInput();
        }

        try {
            $this->pengabdianModel->insert([
                'id_pengabdian' => $id_pengabdian,
                'nip' => $this->nip,
                'judul' => $this->request->getVar('judul'),
                'skim' => $this->request->getVar('skim'),
                'tgl_mulai' => $this->request->getVar('tgl_mulai'),
                'sumber_dana' => $this->request->getVar('sumber_dana')
            ]);

            session()->setFlashdata('pesan', 'Pengabdian berhasil ditambahkan.');
        } catch (\Exception $e) {
            // die($e->getMessage());
            session()->setFlashdata('error', $e->getMessage());
        }

        return redirect()->to('/dosen/pengabdian');
    }

    //--------------------------------------------------------------------

    public function delete($id)
    {
        try {
            $this->pengabdianModel->delete($id);
            session()->setFlashdata('pesan', 'Pengabdian berhasil dihapus.');
        } catch (\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
        }

        return redirect()->to('/dosen/pengabdian');
    }

    //--------------------------------------------------------------------

    public function edit($id)
    {
        //di validasi harus nyalain session();
        $data = [
            'title' => 'Form Edit Pengabdian',
            'validation' => \Config\Services::validation(),
            'pengabdian' => $this->pengabdianModel->getPengabdian($this->nip, $id)
        ];

        return view('pengabdian/edit', $data);
    }

    //--------------------------------------------------------------------

    public function update($id)
    {
        //validasi input
        if (!$this->validate($this->validasi)) {
            return redirect()->to('/dosen/pengabdian/edit/' . $id)->withInput();
        }

        try {
            $this->pengabdianModel->update($id, [
                'judul' => $this->request->getVar('judul'),
                'skim' => $this->request->getVar('skim'),
                'tgl_mulai' => $this->request->getVar('tgl_mulai'),
                'tgl_selesai' => $this->request->getVar('tgl_selesai'),
                'sumber_dana' => $this->request->getVar('sumber_dana')
            ]);

            session()->setFlashdata('pesan', 'Pengabdian berhasil diubah.');
        } catch (\Exception $e) {
            // die($e->getMessage());
            session()->setFlashdata('error', $e->getMessage());
        }

        return redirect()->to('/dosen/pengabdian');
    }

    //--------------------------------------------------------------------

}
