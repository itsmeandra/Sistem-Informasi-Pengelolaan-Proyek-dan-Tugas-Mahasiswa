<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectMemberModel extends Model
{
    protected $table = 'project_members';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_project', 'id_user'];

    /**
     * Mencari id_project berdasarkan id_user yang login.
     * @param int $id_user ID dari user mahasiswa.
     * @return int|null Mengembalikan ID Proyek atau null.
     */
    public function getProjectIdByUserId(int $id_user): ?int
    {
        $result = $this->where('id_user', $id_user)->first();

        if ($result) {
            return (int) $result['id_project'];
        }

        return null;
    }
}
