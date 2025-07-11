<?php

namespace App\Controllers;

use App\Models\TaskModel;
use App\Models\SubmissionModel;

class Nilai extends BaseController
{
    public function index()
    {
        $id_user = session()->get('id_user');
        $submissionModel = new SubmissionModel();
        $taskModel = new TaskModel();

        // Ambil semua laporan tugas mahasiswa ini
        $nilai = $submissionModel->where('id_user', $id_user)->findAll();

        $data['nilaiList'] = [];

        foreach ($nilai as $item) {
            $tugas = $taskModel->find($item['id_task']);
            $data['nilaiList'][] = [
                'nama_tugas' => $tugas['nama_tugas'] ?? '(Tugas Tidak Ditemukan)',
                'deadline' => $tugas['deadline'] ?? '',
                'nilai' => $item['nilai'],
                'status' => $item['nilai'] !== null ? 'Sudah Dinilai' : 'Belum Dinilai',
                'tgl_upload' => $item['tgl_upload'],
            ];
        }

        return view('mahasiswa/nilai', $data);
    }
}
