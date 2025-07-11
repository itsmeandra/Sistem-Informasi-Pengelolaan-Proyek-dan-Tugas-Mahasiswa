<?= $this->include('Template/header'); ?>
<?= $this->include('Template/sidebar_admin'); ?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <h3>👋 Selamat datang, <?= session()->get('nama'); ?> (Admin)</h3>

    <!-- ===== Ringkasan Widget ===== -->
    <div class="row mt-4">
        <?php
        $box = [
            ['primary', '👨‍🏫 Total Dosen', $totalDosen],
            ['info', '🎓 Total Mahasiswa', $totalMahasiswa],
            ['success', '📁 Total Proyek', $totalProyek],
            ['warning', '📄 Total Tugas', $totalTugas],
            ['teal', '👥 Total Anggota', $totalAnggota],
            ['danger', '⏳ Belum Dinilai', $belumDinilai],
        ];
        foreach ($box as $b): ?>
            <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="panel panel-<?= $b[0]; ?>">
                    <div class="panel-heading text-center" style="min-height:55px"><?= $b[1]; ?></div>
                    <div class="panel-body text-center" style="font-size:24px"><?= $b[2]; ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- ===== Quick Action Buttons ===== -->
    <!-- <div class="row mb-3">
        <div class="col-md-12">
            <a href="<?= base_url('admin/users/dosen'); ?>" class="btn btn-primary btn-sm">👨‍🏫 Kelola Dosen</a>
            <a href="<?= base_url('admin/users/mahasiswa'); ?>" class="btn btn-primary btn-sm">🎓 Kelola Mahasiswa</a>
            <a href="<?= base_url('admin/monitor/projects'); ?>" class="btn btn-success btn-sm">📁 Monitoring Proyek</a>
            <a href="<?= base_url('admin/monitor/tasks'); ?>" class="btn btn-success btn-sm">📄 Monitoring Tugas</a>
            <a href="<?= base_url('admin/report/rekap'); ?>" class="btn btn-danger  btn-sm">📄 Laporan PDF</a>
            <a href="<?= base_url('admin/report/rekap-excel'); ?>" class="btn btn-info btn-sm">📊 Laporan Excel</a>
        </div>
    </div> -->

    <!-- ===== Proyek Terbaru ===== -->
    <div class="panel panel-default">
        <div class="panel-heading">🆕 5 Proyek Terbaru</div>
        <div class="panel-body">
            <?php if (empty($proyekTerbaru)): ?>
                <div class="alert alert-info">Belum ada proyek.</div>
            <?php else: ?>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Proyek</th>
                            <th>Dosen</th>
                            <th>Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($proyekTerbaru as $p): ?>
                            <tr>
                                <td><?= esc($p['judul']); ?></td>
                                <td><?= esc($p['dosen']); ?></td>
                                <td><?= date('d M Y', strtotime($p['created_by'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>

</div>
<?= $this->include('Template/footer'); ?>