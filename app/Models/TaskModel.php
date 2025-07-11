<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'id_task';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $allowedFields = [
        'id_project',
        'nama_tugas',
        'deskripsi_tugas',
        'deadline',
        'file_tugas',
        'status'
    ];
}
