<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\UserModel;
use App\Models\ProjectModel;
use App\Models\TaskModel;

class Admin extends BaseController
{
    public function index()
    {
        $user   = new \App\Models\UserModel();
        $proj   = new \App\Models\ProjectModel();
        $task   = new \App\Models\TaskModel();
        $member = new \App\Models\ProjectMemberModel();
        $sub    = new \App\Models\SubmissionModel();

        $totalDosen     = $user->where('role', 'dosen')->countAllResults();
        $totalMahasiswa      = $user->where('role', 'mahasiswa')->countAllResults();
        $totalProyek    = $proj->countAllResults();
        $totalTugas     = $task->countAllResults();
        $totalAnggota   = $member->countAllResults();
        $belumDinilai   = $sub->where('nilai', null)->countAllResults();

        $proyekTerbaru = $proj->select('projects.*, users.nama AS dosen')
            ->join('users', 'users.id_user=projects.created_by', 'left')
            ->orderBy('projects.created_by', 'DESC')->limit(5)->findAll();

        echo view('Template/header');
        echo view('Template/sidebar_admin');
        echo view('admin/index', compact(
            'totalDosen',
            'totalMahasiswa',
            'totalProyek',
            'totalTugas',
            'totalAnggota',
            'belumDinilai',
            'proyekTerbaru'
        ));
        echo view('Template/footer');
    }


    public function usersDosen()
    {
        $model = new \App\Models\UserModel();
        $users = $model->where('role', 'dosen')->findAll();
        return view('admin/users_dosen', ['users' => $users]);
    }

    public function usersMahasiswa()
    {
        $model = new \App\Models\UserModel();
        $users = $model->where('role', 'mahasiswa')->findAll();
        return view('admin/users_mahasiswa', ['users' => $users]);
    }

    public function createUser()
    {
        $role = $this->request->getGet('role') ?? 'mahasiswa';
        return view('admin/user_create', ['defaultRole' => $role]);
    }

    public function storeUser()
    {
        $model = new \App\Models\UserModel();
        $data = [
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            // 'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
        ];
        $model->save($data);
        return redirect()->to('/admin/users/' . $data['role'])->with('success', 'User ditambahkan.');
    }

    public function editUser($id)
    {
        $model = new \App\Models\UserModel();
        $user = $model->find($id);
        return view('admin/user_edit', ['user' => $user]);
    }

    public function updateUser($id)
    {
        $model = new \App\Models\UserModel();
        $data = [
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role')
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $model->update($id, $data);
        return redirect()->to('/admin/users/' . $data['role'])->with('success', 'User diperbarui.');
    }

    public function deleteUser($id)
    {
        $model = new \App\Models\UserModel();
        $user = $model->find($id);
        $model->delete($id);
        return redirect()->to('/admin/users/' . $user['role'])->with('success', 'User dihapus.');
    }

    public function monitorProjects()
    {
        $projModel = new ProjectModel();
        $userModel = new UserModel();

        // $projects = $projModel
        //     ->select('projects.*, users.nama AS nama_dosen')
        //     ->join('users', 'users.id_user = projects.created_by', 'left')
        //     ->orderBy('projects.created_at', 'DESC')
        //     ->findAll();

        $projects = $projModel
            ->select('projects.id_project, projects.judul, projects.deskripsi, projects.created_by, users.nama AS nama_dosen') // Sebutkan kolomnya
            ->join('users', 'users.id_user = projects.created_by', 'left')
            ->orderBy('projects.created_by', 'DESC')
            ->findAll();

        return view('admin/monitor_projects', ['projects' => $projects]);
    }

    public function monitorTasks()
    {
        $taskModel   = new TaskModel();
        $projectModel = new ProjectModel();

        $projectId = $this->request->getGet('project'); // optional filter
        $projects  = $projectModel->findAll();

        if ($projectId) {
            $tasks = $taskModel
                ->where('id_project', $projectId)
                ->orderBy('deadline', 'ASC')
                ->findAll();
        } else {
            $tasks = $taskModel
                ->select('tasks.*, projects.judul')
                ->join('projects', 'projects.id_project = tasks.id_project', 'left')
                ->orderBy('deadline', 'ASC')
                ->findAll();
        }

        return view('admin/monitor_tasks', [
            'tasks'    => $tasks,
            'projects' => $projects,
            'filter'   => $projectId
        ]);
    }

    public function reportRekap()
    {
        $proj  = new ProjectModel();
        $task  = new TaskModel();
        $dosen = new UserModel();

        $projects = $proj->findAll();
        foreach ($projects as &$p) {
            $p['tugas'] = $task->where('id_project', $p['id_project'])->findAll();
            $p['dosen'] = $dosen->find($p['created_by'])['nama'] ?? '-';
        }

        $html = view('admin/report_rekap_pdf', ['projects' => $projects]);

        $pdf = new Dompdf(new Options(['isRemoteEnabled' => true]));
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();
        $pdf->stream('Rekap_Proyek_Tugas.pdf', ['Attachment' => false]);
    }

    public function reportRekapExcel()
    {
        $proj = new ProjectModel();
        $task = new TaskModel();

        $spread = new Spreadsheet();
        $sheet  = $spread->getActiveSheet();
        $sheet->setCellValue('A1', 'Nama Proyek')
            ->setCellValue('B1', 'Dosen')
            ->setCellValue('C1', 'Nama Tugas')
            ->setCellValue('D1', 'Deadline');

        $row = 2;
        $projects = $proj->findAll();
        $userModel = new UserModel();

        foreach ($projects as $p) {
            $tasks = $task->where('id_project', $p['id_project'])->findAll();
            $dosen = $userModel->find($p['created_by'])['nama'] ?? '-';

            if (!$tasks) { // proyek tanpa tugas
                $sheet->fromArray([$p['nama_project'], $dosen, '-', '-'], null, "A$row");
                $row++;
            } else {
                foreach ($tasks as $t) {
                    $sheet->fromArray([$p['nama_project'], $dosen, $t['nama_tugas'], $t['deadline']], null, "A$row");
                    $row++;
                }
            }
        }

        $writer = new Xlsx($spread);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Rekap_Proyek_Tugas.xlsx"');
        $writer->save('php://output');
        exit;
    }
}
