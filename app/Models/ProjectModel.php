<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $table = 'projects';
    protected $primaryKey = 'id_project';
    protected $allowedFields = ['judul', 'deskripsi', 'deadline', 'created_by'];

    /**
     * Fungsi untuk menghitung semua proyek yang ada di database.
     * @return int
     */
    public function countAllProjects(): int
    {
        // Menggunakan Query Builder bawaan CodeIgniter untuk menghitung baris
        return $this->countAllResults();
    }
}
