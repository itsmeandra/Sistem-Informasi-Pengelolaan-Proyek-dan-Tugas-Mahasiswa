<?php

namespace App\Controllers;

use App\Models\TaskModel;
use App\Models\ProjectModel;
use App\Models\SubmissionModel;

class Task extends BaseController
{
    protected $taskModel;

    public function __construct()
    {
        $this->taskModel = new TaskModel();
    }

    public function index($id_project)
    {
        $taskModel = new TaskModel();
        $data['tasks'] = $taskModel->where('id_project', $id_project)->findAll();
        $data['id_project'] = $id_project;

        return view('task/index', $data);
    }

    public function create($id_project)
    {
        if ($this->request->getMethod() !== 'post') {
            return view('task/create', ['id_project' => $id_project]);
        }

        $rules = [
            'id_project'      => 'required|numeric',
            'nama_tugas'      => 'required|min_length[3]',
            'deadline'        => 'required|valid_date',
            'deskripsi_tugas' => 'required',
            'file_tugas'      => 'uploaded[file_tugas]|max_size[file_tugas,2048]|ext_in[file_tugas,pdf,doc,docx,zip]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('file_tugas');
        $namaFile = $file->getRandomName();
        $file->move('uploads/tugas', $namaFile);

        $taskModel = new \App\Models\TaskModel();
        $taskModel->save([
            'id_project'      => $this->request->getPost('id_project'),
            'nama_tugas'      => $this->request->getPost('nama_tugas'),
            'deadline'        => $this->request->getPost('deadline'),
            'deskripsi_tugas' => $this->request->getPost('deskripsi_tugas'),
            'file_tugas'      => $namaFile
        ]);

        return redirect()->to('/project/' . $this->request->getPost('id_project'))->with('success', 'Tugas berhasil dibuat.');
    }

    public function store()
    {
        $rules = [
            'id_project'      => 'required|numeric',
            'nama_tugas'      => 'required|min_length[3]',
            'deskripsi_tugas' => 'required',
            'deadline'        => 'required|valid_date',
            'file_tugas'      => 'max_size[file_tugas,2048]|ext_in[file_tugas,pdf,doc,docx,zip]' // File opsional, maks 2MB
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $taskModel = new TaskModel();
        $file = $this->request->getFile('file_tugas');
        $namaFile = null;

        if ($file->isValid() && !$file->hasMoved()) {
            $namaFile = $file->getRandomName();
            $file->move('uploads/tugas', $namaFile);
        }

        $data = [
            'id_project'      => $this->request->getPost('id_project'),
            'nama_tugas'      => $this->request->getPost('nama_tugas'),
            'deskripsi_tugas' => $this->request->getPost('deskripsi_tugas'),
            'deadline'        => $this->request->getPost('deadline'),
            'file_tugas'      => $namaFile,
            'status'          => 'belum'
        ];

        $taskModel->save($data);

        return redirect()->to('/task/' . $data['id_project'])->with('success', 'Tugas berhasil ditambahkan');
    }

    public function upload($id_task)
    {
        return view('task/upload', ['id_task' => $id_task]);
    }

    public function saveUpload()
    {
        $file = $this->request->getFile('file_laporan');
        $id_task = $this->request->getPost('id_task');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move('uploads', $fileName);

            $data = [
                'id_task'      => $id_task,
                'id_user'      => session()->get('id_user'),
                'file_laporan'    => $fileName // <-- Tambahan
            ];

            $db = \Config\Database::connect();
            $db->table('task_submissions')->insert($data);

            return redirect()->to('/task/' . $id_task)->with('success', 'Laporan berhasil diunggah');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal mengunggah file. Silakan pilih file yang valid.');
        }
    }

    public function nilai($id_submission)
    {
        return view('task/nilai', ['id_submission' => $id_submission]);
    }

    public function simpanNilai()
    {
        $submissionModel = new \App\Models\SubmissionModel();

        $id_submission = $this->request->getPost('id_submission');
        $nilai = $this->request->getPost('nilai');

        $submissionModel->update($id_submission, [
            'nilai' => $nilai
        ]);

        return redirect()->to('/task/nilai/' . $id_submission)->with('success', 'Nilai berhasil disimpan.');
    }

    public function laporanSemua()
    {
        $submissionModel = new \App\Models\SubmissionModel();
        $taskModel = new \App\Models\TaskModel();
        $projectModel = new \App\Models\ProjectModel();
        $userModel = new \App\Models\UserModel();

        $id_dosen = session()->get('id_user');

        $proyekIds = $projectModel->where('created_by', $id_dosen)->findColumn('id_project');
        $taskIds = $taskModel->whereIn('id_project', $proyekIds)->findColumn('id_task');

        $submissions = $submissionModel->whereIn('id_task', $taskIds)->findAll();

        $data['laporan'] = [];

        foreach ($submissions as $s) {
            $user = $userModel->find($s['id_user']);
            $task = $taskModel->find($s['id_task']);

            $data['laporan'][] = [
                'id_submission' => $s['id_submission'],
                'nama_mahasiswa' => $user['nama'],
                'nim' => $user['username'],
                'nama_tugas' => $task['nama_tugas'],
                'deadline' => $task['deadline'],
                'file' => $s['file_laporan'],
                'nilai' => $s['nilai'],
                // 'komentar' => $s['komentar'],
                'tgl_upload' => $s['tgl_upload']
            ];
        }

        return view('task/laporan-tugas', $data);
    }
}
