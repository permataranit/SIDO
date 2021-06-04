<?php

namespace App\Controllers;

use App\Controllers\ModelConfig;

class Jadwal extends BaseController
{
    private $model;

    protected $jadwalModel, $pengabdianModel, $penelitianModel, $pendidikanModel, $id_nip;

    public function __construct()
    {
        $this->model = new ModelConfig();

        $this->jadwalModel = $this->model->JadwalModel;
        $this->pendidikanModel = $this->model->PendidikanModel;
        $this->pengabdianModel = $this->model->PengabdianModel;
        $this->penelitianModel = $this->model->PenelitianModel;
        $this->id_nip = session()->get('ses_id');
        date_default_timezone_set("Asia/Bangkok");
    }

    public function index($tanggal = FALSE)
    {

        if ($tanggal == FALSE) {
            $tanggal = date("Y-m-d");
        }

        $jadwal = $this->jadwalModel->where(['nip' => $this->id_nip, 'tanggal' => $tanggal])
            ->findAll();

        $data = [
            'title' => 'Jadwal Hari Ini',
            'jadwal' => $jadwal
        ];

        return view('jadwal/index', $data);
    }

    //--------------------------------------------------------------------

    public function index_month($bulan = FALSE, $tahun = FALSE)
    {

        if ($bulan == FALSE) {
            $bulan = date('n');
        }

        if ($tahun == FALSE) {
            $tahun = date('Y');
        }

        $jadwal = $this->jadwalModel->where(['nip' => $this->id_nip, 'YEAR(tanggal)' => $tahun, 'MONTH(tanggal)' => $bulan])
            ->orderBy('tanggal ASC, waktu_mulai ASC')
            // ->orderBy('waktu_mulai', 'ASC')
            ->findAll();

        $monthYear = date('F', mktime(0, 0, 0, $bulan, 10)) . " $tahun";

        $timestamp = mktime(0, 0, 0, $bulan, 1, $tahun); //untuk bikin timestamp sendiri
        $maxday    = date("t", $timestamp); //banyaknya hari pada bulan itu (28,29,30,31)

        $thismonth = getdate($timestamp); //kembalian array
        //dd($thismonth);
        $startday  = $thismonth['wday']; //kembalian hari pertama pada bulan tersebut.
        //misal tanggal 1 nya senin, maka kembaliannya 1

        $data = [
            'title' => 'Jadwal Bulan',
            'jadwal' => $jadwal,
            'bulanTahun' => $monthYear,
            'maxday' => $maxday,
            'startday' => $startday,
            'bulanTgl' => $bulan,
            'tahunTgl' => $tahun
        ];

        return view('jadwal/perbulan', $data);
    }

    //--------------------------------------------------------------------

    public function create()
    {
        $pendidikan = $this->pendidikanModel->getPendidikan();
        $penelitian = $this->penelitianModel->getPenelitian($this->id_nip);
        $pengabdian = $this->pengabdianModel->getPengabdian($this->id_nip);
        //di validasi harus nyalain session();
        $data = [
            'title' => 'Form Tambah Jadwal',
            'pendidikan' => 'halo ini pendidikan',
            'penelitian' => $penelitian,
            'pengabdian' => $pengabdian,
            'pendidikan' => $pendidikan,
            'validation' => \Config\Services::validation()
        ];

        return view('jadwal/create', $data);
    }

    //--------------------------------------------------------------------

    public function save()
    {
        //validasi input
        if (!$this->validate([
            'jenis_keg' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih salah satu kategori kegiatan!',
                ]
            ],
            'keg_apa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih salah satu agenda!',
                ]
            ],
            'judul_agenda' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Beri judul pada jadwal!',
                ]
            ],
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jadwal harus memiliki tanggal',
                ]
            ],
            'w_start' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Waktu mulai harus diisi',
                ]
            ]
        ])) {
            //$validation = \Config\Services::validation();
            // return redirect()->to('/dosen/create')->withInput()->with('validation', $validation);
            return redirect()->to('/dosen/jadwal/create')->withInput();
        }

        //$this->request->getVar() untuk mengambil data yang dikirim
        //kalo getVar itu bisa methode apa aja
        //kalo getPost khusus data yang dikirim lewat Post
        //getGet juga untuk data yang dikirim lewat Get
        //you must using insert cuz save method wont work
        try {
            $tanggal = strtotime($this->request->getVar('tanggal'));
            $bulan = date('n', $tanggal);
            $tahun = date('Y', $tanggal);

            $jenisKeg = $this->request->getVar('jenis_keg'); //cari id jenis_keg dan ambil valuenya

            if ($jenisKeg == 1) {
                $kegiatan = "id_pendidikan";
                $id_keg = $this->request->getVar('keg_apa');
            } else if ($jenisKeg == 2) {
                $kegiatan = "id_penelitian";
                $id_keg = $this->request->getVar('keg_apa');
            } else if ($jenisKeg == 3) {
                $kegiatan = "id_pengabdian";
                $id_keg = $this->request->getVar('keg_apa');
            }

            $this->dosenModel->insert([
                'nip' => $this->id_nip,
                'nama_acara' => $this->request->getVar('judul_agenda'),
                'tanggal' => $this->request->getVar('tanggal'),
                'waktu_mulai' => $this->request->getVar('w_start'),
                'waktu_selesai' => $this->request->getVar('w_end'),
                'tempat' => $this->request->getVar('lokasi'),
                $kegiatan => $id_keg,
                'keterangan' => $this->request->getVar('ket')
            ]);

            session()->setFlashdata('pesan', 'Jadwal berhasil ditambahkan.');
        } catch (\Exception $e) {
            // die($e->getMessage());
            session()->setFlashdata('error', $e->getMessage());
        }

        return redirect()->to("/dosen/bulan/" . $bulan . "/" . $tahun);
    }

    //--------------------------------------------------------------------

    public function delete($id, $tanggal)
    {
        $bulan = date('n', $tanggal);
        $tahun = date('Y', $tanggal);

        try {
            $this->jadwalModel->delete($id);
            session()->setFlashdata('pesan', 'Jadwal berhasil dihapus.');
        } catch (\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
        }

        return redirect()->to("/dosen/bulan/" . $bulan . "/" . $tahun);
    }

    //--------------------------------------------------------------------

    //--------------------------------------------------------------------

    public function agenda($id)
    {
        if ($id[0] === "B") {
            $agenda = $this->jadwalModel->where(['id_penelitian' => $id])->findAll();
            $keg = "Penelitian";
        } else if ($id[0] === "C") {
            $agenda = $this->jadwalModel->where(['id_pengabdian' => $id])->findAll();
            $keg = "Pengabdian";
        }

        $data = [
            'title' => 'Agenda ' . $keg,
            'jadwal' => $agenda,
            'keg' => $keg
        ];

        return view('jadwal/index', $data);
    }
}
