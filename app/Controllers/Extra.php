<?php

namespace App\Controllers;

use App\Models\ProjectModel;
use App\Models\ProjectMemberModel;
use App\Models\UserModel;
use App\Models\TaskModel;
use App\Models\SubmissionModel;

class Extra extends BaseController
{
    public function peserta($project_id)
    {
        $anggotaModel = new ProjectMemberModel();
        $userModel = new UserModel();

        $anggota = $anggotaModel->where('id_project', $project_id)->findAll();
        $data['peserta'] = [];

        foreach ($anggota as $row) {
            $data['peserta'][] = $userModel->find($row['id_user']);
        }

        return view('project/peserta', $data);
    }

    public function reminder()
    {
        $taskModel = new \App\Models\TaskModel();

        // Hapus filter tanggal, cukup filter berdasarkan status
        $data['reminder'] = $taskModel
            ->where('status !=', 'selesai')
            ->orderBy('deadline', 'ASC') // Tetap urutkan dari yang paling dekat
            ->findAll();

        return view('task/reminder', $data);
    }

    public function deadline()
    {
        $taskModel = new \App\Models\TaskModel();
        $today = \CodeIgniter\I18n\Time::today();

        // Ambil hanya 3 tugas dengan deadline terdekat
        $data['reminder'] = $taskModel
            ->where('status !=', 'Selesai') // 1. Ambil tugas yang belum selesai
            ->where('deadline >=', $today)   // 2. Filter deadline mulai dari HARI INI
            ->orderBy('deadline', 'ASC')     // 3. Urutkan dari yang PALING DEKAT
            ->limit(3)                       // 4. BATASI hasilnya hanya 3
            ->findAll();

        // Kirim data ini ke view Anda
        return view('dashboard/dosen', $data);
    }

    public function statistik($project_id)
    {
        $taskModel = new TaskModel();
        $submissionModel = new SubmissionModel();

        $tugas = $taskModel->where('id_project', $project_id)->findAll();

        $stat = [
            'total_tugas' => count($tugas),
            'total_laporan' => 0,
            'rata_rata_nilai' => 0
        ];

        $nilai_total = 0;
        $nilai_count = 0;

        foreach ($tugas as $task) {
            $laporan = $submissionModel->where('id_task', $task['id_task'])->findAll();
            $stat['total_laporan'] += count($laporan);

            foreach ($laporan as $lap) {
                if ($lap['nilai'] !== null) {
                    $nilai_total += $lap['nilai'];
                    $nilai_count++;
                }
            }
        }

        $stat['rata_rata_nilai'] = $nilai_count > 0 ? round($nilai_total / $nilai_count, 2) : 0;

        return view('project/statistik', ['stat' => $stat]);
    }
}
