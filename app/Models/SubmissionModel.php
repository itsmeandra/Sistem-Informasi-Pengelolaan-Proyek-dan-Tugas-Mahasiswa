<?php

namespace App\Models;

use CodeIgniter\Model;

class SubmissionModel extends Model
{
    protected $table = 'task_submissions';
    protected $primaryKey = 'id_submission';
    protected $allowedFields = ['id_task', 'id_user', 'file_laporan', 'tgl_upload', 'nilai', 'komentar'];
    protected $useTimestamps = false;
}
