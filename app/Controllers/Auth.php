<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    // public function proses_Login()
    // {
    //     $username = $this->request->getPost('username');
    //     $password = $this->request->getPost('password');

    //     $userModel = new UserModel();
    //     $user = $userModel->where('username', $username)->first();

    //     if ($user && password_verify($password, $user['password'])) {
    //         session()->set([
    //             'id_user' => $user['id_user'],
    //             'nama' => $user['nama'],
    //             'role' => $user['role'],
    //             'logged_in' => true
    //         ]);

    //         if ($user['role'] == 'dosen') {
    //             return redirect()->to('/dashboard/dosen');
    //         } else {
    //             return redirect()->to('/dashboard/mahasiswa');
    //         }
    //     }

    //     return redirect()->back()->with('error', 'Username atau Password salah.');
    // }

    public function proses_Login()
    {
        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Username dan Password wajib diisi.');
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            $sessionData = [
                'id_user'   => $user['id_user'],
                'nama'      => $user['nama'],
                'role'      => $user['role'],
                'logged_in' => true
            ];

            session()->set($sessionData);
            switch ($user['role']) {
                case 'admin':
                    return redirect()->to('/admin/index');              // admin panel
                case 'dosen':
                    return redirect()->to('/dashboard/dosen');    // dashboard dosen
                default:
                    return redirect()->to('/dashboard/mahasiswa');
            }
            // $redirectUrl = ($user['role'] == 'admin') ? '/admin/index' : (($user['role'] == 'dosen') ? '/dashboard/dosen' : '/dashboard/mahasiswa');
            // $redirectUrl = ($user['role'] == 'dosen') ? '/dashboard/dosen' : '/dashboard/mahasiswa';
            session()->setFlashdata('success', 'Login Berhasil!');
            // return redirect()->to($redirectUrl);
        }

        return redirect()->back()->withInput()->with('error', 'Username atau Password salah.');
    }

    public function logout()
    {
        session()->destroy();
        session()->setFlashdata('info', 'Anda telah keluar!');
        return redirect()->to('/auth/login');
    }
}
