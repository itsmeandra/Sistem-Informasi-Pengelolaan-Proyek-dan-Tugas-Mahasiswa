<?php

use App\Models\ProjectMemberModel;

if (!function_exists('getMahasiswaProjectId')) {
    // function getMahasiswaProjectId()
    // {
    //     if (!session()->get('logged_in') || session()->get('role') !== 'mahasiswa') {
    //         return null;
    //     }

    //     $model = new ProjectMemberModel();
    //     $entry = $model->where('id_user', session()->get('id_user'))->first();

    //     return $entry ? $entry['id_project'] : null;
    // }

    function getMahasiswaProjectId(): ?int
    {
        // 1. Dapatkan service database
        $db = \Config\Database::connect();

        // 2. Dapatkan id_user dari sesi
        $id_user = session()->get('id_user');

        // Jika tidak ada user yang login, kembalikan null
        if (!$id_user) {
            return null;
        }

        // 3. Buat query untuk mencari id_project di tabel peserta
        //    GANTI 'peserta_proyek' dengan nama tabel Anda yang menyimpan
        //    data mahasiswa yang join ke proyek.
        $builder = $db->table('peserta_proyek');
        $builder->select('id_project');
        $builder->where('id_user', $id_user); // Asumsi kolom foreign key-nya adalah id_user
        $builder->limit(1); // Kita hanya butuh satu hasil

        $query = $builder->get();

        // 4. Periksa hasilnya
        if ($query->getNumRows() > 0) {
            // Jika ditemukan, kembalikan nilai id_project
            $row = $query->getRow();
            return (int) $row->id_project;
        }

        // 5. Jika tidak ditemukan, kembalikan null
        return null;
    }
}
