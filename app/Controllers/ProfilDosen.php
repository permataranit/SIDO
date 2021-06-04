<?php

namespace App\Controllers;

use App\Controllers\ModelConfig;

class ProfilDosen extends BaseController
{
    private $model;

    protected $dosenModel, $pengabdianModel, $penelitianModel, $id_nip;

    function __construct()
    {
        $this->model = new ModelConfig();

        // Nah, selesai. Sekarang, bagaimana cara memanggil Modelnya?
        // Tinggal seperti ini:
        $this->dosenModel = $this->model->DosenModel;
        $this->pengabdianModel = $this->model->PengabdianModel;
        $this->penelitianModel = $this->model->PenelitianModel;
        $this->id_nip = session()->get('ses_id');
    }

    public function index($nip)
    {
        $dosen = $this->dosenModel->getDosen($nip);
        $penelitian = $this->penelitianModel->getPenelitian($nip);
        $pengabdian = $this->pengabdianModel->getPengabdian($nip);

        $sama = FALSE;
        if ($this->id_nip == $nip) {
            $sama = TRUE;
        }

        $data = [
            'title' => 'Profil Dosen',
            'dosen' => $dosen,
            'penelitian' => $penelitian,
            'pengabdian' => $pengabdian,
            'sama' => $sama
        ];

        return view('dosen/profil', $data);
    }
}
