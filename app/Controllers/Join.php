<?php

namespace App\Controllers;

use App\Models\ProjectModel;
use App\Models\ProjectMemberModel;

class Join extends BaseController
{
    public function list()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'mahasiswa') {
            return redirect()->to('/auth/login');
        }

        $model = new ProjectModel();
        $data['projects'] = $model->findAll();

        return view('join/list', $data);
    }

    public function join($id)
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'mahasiswa') {
            return redirect()->to('/auth/login');
        }

        $memberModel = new ProjectMemberModel();
        $cek = $memberModel->where([
            'id_project' => $id,
            'id_user' => session()->get('id_user')
        ])->first();

        if (!$cek) {
            $memberModel->insert([
                'id_project' => $id,
                'id_user' => session()->get('id_user')
            ]);
            return redirect()->to('/join')->with('success', 'Berhasil bergabung ke proyek!');
        } else {
            return redirect()->to('/join')->with('error', 'Anda sudah bergabung pada proyek ini!');
        }
    }
}
