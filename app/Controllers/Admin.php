<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Admin extends BaseController
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

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
        $user = $this->adminModel->where(['id_admin' => $id])->first();
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
            return redirect()->to('/admin/password')->withInput();
        }

        try {
            $this->adminModel->update($id, [
                'password' => $this->request->getVar('baru')
            ]);
            session()->setFlashdata('pesan', 'Password berhasil diubah.');
        } catch (\Exception $e) {
            // die($e->getMessage());
            session()->setFlashdata('error', $e->getMessage());
        }

        return redirect()->to('/admin/password');
    }

    //--------------------------------------------------------------------

}
