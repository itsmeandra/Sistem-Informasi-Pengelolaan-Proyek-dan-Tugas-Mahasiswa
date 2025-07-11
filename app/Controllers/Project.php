<?php

namespace App\Controllers;

use App\Models\ProjectMemberModel;
use App\Models\ProjectModel;
use App\Models\SubmissionModel;
use App\Models\TaskModel;
use App\Models\UserModel;

class Project extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'dosen') {
            return redirect()->to('/auth/login');
        }

        $projectModel = new ProjectModel();
        $data['projects'] = $projectModel->where('created_by', session()->get('id_user'))->findAll();

        return view('project/index', $data);
    }

    public function create()
    {
        return view('project/create');
    }

    public function store()
    {
        $projectModel = new ProjectModel();

        $data = [
            'judul' => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'deadline' => $this->request->getPost('deadline'),
            'created_by' => session()->get('id_user')
        ];

        $projectModel->insert($data);

        return redirect()->to('/project')->with('success', 'Proyek berhasil dibuat');
    }

    public function edit($id)
    {
        $model = new ProjectModel();
        $data['project'] = $model->find($id);
        return view('project/edit-project', $data);
    }

    public function update($id)
    {
        $model = new ProjectModel();
        $data = [
            'judul' => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'deadline' => $this->request->getPost('deadline'),
        ];
        $model->update($id, $data);
        return redirect()->to('/project')->with('success', 'Proyek berhasil diperbarui');
    }

    public function delete($id)
    {
        // $model = new ProjectModel();
        // $model->delete($id);
        // return redirect()->to('/project')->with('success', 'Proyek berhasil dihapus');

        $projectModel    = new ProjectModel();
        $taskModel       = new TaskModel();
        $memberModel     = new ProjectMemberModel();
        $submissionModel = new SubmissionModel();
        $db              = \Config\Database::connect();

        $db->transStart();

        $taskIds = $taskModel->where('id_project', $id)->findColumn('id_task');

        if (!empty($taskIds)) {
            $submissionModel->whereIn('id_task', $taskIds)->delete();
        }

        $taskModel->where('id_project', $id)->delete();
        $memberModel->where('id_project', $id)->delete();
        $projectModel->delete($id);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Gagal menghapus proyek karena data terkait tidak dapat dihapus.');
        } else {
            return redirect()->to('/project')->with('success', 'Project berhasil dihapus.');
        }
    }
}
