<?php

namespace App\Controllers;

use App\Models\ProjectMemberModel;
use App\Models\ProjectModel;
use App\Models\SubmissionModel;
use App\Models\TaskModel;

use CodeIgniter\I18n\Time;

class Dashboard extends BaseController
{
    private function checkLogin()
    {
        if (!session()->get('logged_in') || session()->get('role') == '') {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
            return redirect()->to('/auth/login');
        }
    }

    public function mahasiswa()
    {
        $id_user = session()->get('id_user');

        $memberModel = new ProjectMemberModel();
        $projectModel = new ProjectModel();
        $taskModel = new TaskModel();
        $submissionModel = new SubmissionModel();

        // 📌 1. Proyek yang diikuti
        $projectMember = $memberModel->where('id_user', $id_user)->first();
        $nama_project = '-';
        $id_project = null;

        if ($projectMember) {
            $id_project = $projectMember['id_project'];
            $project = $projectModel->find($id_project);
            $nama_project = $project['nama_project'] ?? '-';
        }

        // 2. Tugas Aktif (belum upload & deadline belum lewat)
        $today = date('Y-m-d');
        $tugasAktif = [];

        if ($id_project) {
            $tasks = $taskModel
                ->where('id_project', $id_project)
                ->where('deadline >=', $today)
                ->findAll();

            foreach ($tasks as $t) {
                $laporan = $submissionModel
                    ->where('id_task', $t['id_task'])
                    ->where('id_user', $id_user)
                    ->first();

                if (!$laporan || empty($laporan['file_laporan'])) {
                    $tugasAktif[] = $t;
                }
            }
        }

        //3. Deadline Terdekat (H-0 s/d H-7)
        $tugasTerdekat = [];

        if ($id_project) {
            $tasks = $taskModel
                ->where('id_project', $id_project)
                ->where('deadline >=', $today)
                ->orderBy('deadline', 'ASC')
                ->limit(3)
                ->findAll();

            foreach ($tasks as $t) {
                $deadline = new \DateTime($t['deadline']);
                $selisih = (new \DateTime())->diff($deadline)->days;

                if ($selisih <= 7) {
                    $tugasTerdekat[] = [
                        'nama_tugas' => $t['nama_tugas'],
                        'deadline' => $t['deadline'],
                        'h' => $selisih
                    ];
                }
            }
        }

        $tasks = $taskModel->where('id_project', $id_project)->findAll();
        $totalTugas = count($tasks);

        // 📊 4. Riwayat Tugas & Nilai
        $riwayatTugas = [];
        if ($id_project) {
            $tasks = $taskModel->where('id_project', $id_project)->findAll();

            foreach ($tasks as $t) {
                $laporan = $submissionModel
                    ->where('id_task', $t['id_task'])
                    ->where('id_user', $id_user)
                    ->first();

                $riwayatTugas[] = [
                    'nama_tugas' => $t['nama_tugas'],
                    'file_laporan' => $laporan['file_laporan'] ?? null,
                    'nilai' => $laporan['nilai'] ?? null,
                ];
            }
        }

        // 📈 5. Grafik Nilai (Chart.js)
        $labelTugas = [];
        $nilaiTugas = [];
        $totalNilai = 0;
        $jumlahDinilai = 0;

        foreach ($riwayatTugas as $r) {
            $labelTugas[] = $r['nama_tugas'];
            $nilaiTugas[] = $r['nilai'] ?? 0;

            if (!is_null($r['nilai'])) {
                $totalNilai += $r['nilai'];
                $jumlahDinilai++;
            }
        }

        $rataNilai = $jumlahDinilai > 0 ? round($totalNilai / $jumlahDinilai, 2) : null;

        $data = [
            'nama_project' => $nama_project,
            'tugasAktif' => $tugasAktif,
            'tugasTerdekat' => $tugasTerdekat,
            'riwayatTugas' => $riwayatTugas,
            'labelTugas' => $labelTugas,
            'nilaiTugas' => $nilaiTugas,
            'totalTugas' => $totalTugas,
            'rataNilai' => $rataNilai
        ];

        echo view('Template/header');
        echo view('Template/sidebar');
        echo view('dashboard/mahasiswa', $data);
        echo view('Template/footer');
    }

    public function dosen()
    {
        $id_user = session()->get('id_user');

        $projectModel = new \App\Models\ProjectModel();
        $taskModel = new \App\Models\TaskModel();
        $submissionModel = new \App\Models\SubmissionModel();
        $memberModel = new \App\Models\ProjectMemberModel();

        // Jumlah proyek
        $projects = $projectModel->where('created_by', $id_user)->findAll();
        $totalProyek = count($projects);
        $projectIds = array_column($projects, 'id_project');

        // Jumlah tugas
        $taskIds   = [];
        $totalTugas = 0;
        $taskIds = $taskModel->whereIn('id_project', $projectIds)->findColumn('id_task');
        $totalTugas = count($taskIds);

        // $totalAnggota = 0;
        // if (!empty($projectIds)) {
        //     $totalAnggota = $memberModel
        //         ->whereIn('id_project', $projectIds)
        //         ->countAllResults();
        // }
        $totalAnggota = $memberModel->whereIn('id_project', $projectIds)->countAllResults();


        // Laporan belum dinilai
        $belumDinilai = 0;
        if (!empty($taskIds)) {
            $belumDinilai = $submissionModel
                ->whereIn('id_task', $taskIds)
                ->where('nilai', null)
                ->countAllResults();
        }

        // Ambil 3 proyek terbaru
        $proyekTerbaru = $projectModel
            ->where('created_by', $id_user)
            ->orderBy('id_project', 'DESC')
            ->limit(3)
            ->findAll();

        $data = [
            'totalProyek' => $totalProyek,
            'totalTugas' => $totalTugas,
            'belumDinilai' => $belumDinilai,
            'proyekTerbaru' => $proyekTerbaru,
            'anggotaProject' => $totalAnggota
        ];
        echo view('Template/header');
        echo view('dashboard/dosen', $data);
        echo view('Template/sidebar');
        echo view('Template/footer');
    }
}
