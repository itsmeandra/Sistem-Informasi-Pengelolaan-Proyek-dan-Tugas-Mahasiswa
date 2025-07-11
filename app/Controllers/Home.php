<?php

namespace App\Controllers;

use App\Models\M_Proyek;
use CodeIgniter\Controller;

class ProyekController extends BaseController
{
    protected $proyekModel;

    public function __construct()
    {
        $this->proyekModel = new M_Proyek();
    }

    // Menampilkan semua proyek
    public function index()
    {
        $data['judul'] = 'Daftar Proyek';
        $data['proyek'] = $this->proyekModel->findAll();

        echo view('Template/header', $data);
        echo view('Template/sidebar');
        echo view('Proyek/index', $data);
        echo view('Template/footer');
    }

    // Menampilkan form tambah proyek
    public function create()
    {
        $data['judul'] = 'Tambah Proyek';

        echo view('Template/header', $data);
        echo view('Template/sidebar');
        echo view('Proyek/create');
        echo view('Template/footer');
    }

    // Menyimpan proyek baru
    public function add()
    {
        // Validasi inputan
        if (!$this->validate([
            'nama_proyek' => 'required',
            'deskripsi' => 'required',
            'deadline' => 'required|valid_date'
        ])) {
            return redirect()->back()->withInput()->with('error', 'Data tidak valid!');
        }

        // Simpan ke database
        $this->proyekModel->save([
            'nama_proyek' => $this->request->getPost('nama_proyek'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'deadline' => $this->request->getPost('deadline'),
        ]);

        return redirect()->to('/proyek')->with('success', 'Proyek berhasil ditambahkan!');
    }
}
