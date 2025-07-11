<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\ProjectModel;
use App\Models\SubmissionModel;
use App\Models\TaskModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Export extends BaseController
{
    public function pdfProject()
    {
        $model = new ProjectModel();
        $projects = $model->findAll();

        $html = view('export/pdf_project', ['projects' => $projects]);

        $dompdf = new Dompdf(new Options());
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("Daftar_Proyek.pdf", ['Attachment' => false]);
    }

    public function excelProject()
    {
        $model = new ProjectModel();
        $projects = $model->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Proyek');
        $sheet->setCellValue('C1', 'Deskripsi');
        $sheet->setCellValue('D1', 'Deskripsi');

        $row = 2;
        $no = 1;
        foreach ($projects as $p) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $p['judul']);
            $sheet->setCellValue('C' . $row, $p['deskripsi']);
            $sheet->setCellValue('D' . $row, $p['deadline']);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'Daftar_Proyek.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"$filename\"");
        $writer->save('php://output');
        exit;
    }

    public function pdfTugas($id_project)
    {
        $model = new TaskModel();
        $tasks = $model->where('id_project', $id_project)->findAll();
        $html = view('export/pdf_tugas', ['tasks' => $tasks]);
        $pdf = new Dompdf();
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        $pdf->stream("Daftar_Tugas_Project_$id_project.pdf", ['Attachment' => false]);
    }

    public function excelTugas($id_project)
    {
        $model = new TaskModel();
        $tasks = $model->where('id_project', $id_project)->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Tugas');
        $sheet->setCellValue('C1', 'Deadline');
        $sheet->setCellValue('D1', 'Deadline');

        $row = 2;
        $no = 1;
        foreach ($tasks as $t) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $t['nama_tugas']);
            $sheet->setCellValue('C' . $row, $t['deskripsi_tugas']);
            $sheet->setCellValue('D' . $row, $t['deadline']);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = "Daftar_Tugas_Project_$id_project.xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"$filename\"");
        $writer->save('php://output');
        exit;
    }

    private function _getSubmissionData(): array
    {
        $submissionModel = new SubmissionModel();

        // Query dengan JOIN untuk menggabungkan 3 tabel
        return $submissionModel
            ->select('submissions.status, submissions.nilai, submissions.file_laporan,
                      tasks.nama_tugas, tasks.deadline,
                      users.nama as nama_mahasiswa, users.username as nim')
            ->join('tasks', 'tasks.id_task = submissions.id_task')
            ->join('users', 'users.id_user = submissions.id_user')
            ->orderBy('tasks.deadline', 'DESC')
            ->findAll();
    }

    public function pdfLaporanTugas()
    {
        $data['submissions'] = $this->_getSubmissionData();

        $html = view('export/pdf_submissions', $data);

        $options = new Options();
        $options->set('isRemoteEnabled', true); // Izinkan gambar/CSS eksternal
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("Laporan_Tugas_Mahasiswa.pdf", ['Attachment' => false]);
    }

    public function excelLaporanTugas()
    {
        // Ambil data menggunakan fungsi privat
        $submissions = $this->_getSubmissionData();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set Header
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Mahasiswa');
        $sheet->setCellValue('C1', 'NIM');
        $sheet->setCellValue('D1', 'Tugas');
        $sheet->setCellValue('E1', 'Deadline');
        $sheet->setCellValue('F1', 'File');
        $sheet->setCellValue('G1', 'Status');
        $sheet->setCellValue('H1', 'Nilai');

        // Isi Data
        $row = 2;
        $no = 1;
        foreach ($submissions as $sub) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $sub['nama_mahasiswa']);
            $sheet->setCellValue('C' . $row, $sub['nim']);
            $sheet->setCellValue('D' . $row, $sub['nama_tugas']);
            $sheet->setCellValue('E' . $row, $sub['deadline']);
            $sheet->setCellValue('F' . $row, $sub['file_laporan']);
            $sheet->setCellValue('G' . $row, $sub['status']);
            $sheet->setCellValue('H' . $row, $sub['nilai']);
            $row++;
        }

        // Konfigurasi untuk download
        $writer = new Xlsx($spreadsheet);
        $filename = 'Laporan_Tugas_Mahasiswa.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"$filename\"");
        $writer->save('php://output');
        exit;
    }
}
