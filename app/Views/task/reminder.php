<?= $this->include('Template/header'); ?>
<?= $this->include('Template/sidebar'); ?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">Deadline Tugas</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3>Daftar Deadline Tugas</h3>

            <?php if (empty($reminder)): ?>
                <div class="col-12">
                    <p class="text-center text-muted">Tidak ada deadline dalam waktu dekat.</p>
                </div>
            <?php else: ?>
                <?php
                $role = session()->get('role');
                foreach ($reminder as $task): ?>
                    <?php
                    $deadline = new DateTime($task['deadline']);
                    $today = new DateTime('today'); // Gunakan 'today' agar waktu tidak ikut terhitung
                    $interval = $today->diff($deadline);
                    $days_left = (int)$interval->format('%r%a');

                    // Menentukan warna border card dan teks badge berdasarkan urgensi
                    $border_color = '';
                    if ($days_left < 0) {
                        $badge_text = 'Sudah Lewat';
                        $badge_class = 'bg-light text-dark'; // Warna netral untuk yang sudah lewat
                        $border_color = 'border-secondary';
                    } elseif ($days_left < 1) {
                        $badge_text = 'Hari Ini';
                        $badge_class = 'bg-danger text-white';
                        $border_color = 'border-danger';
                    } elseif ($days_left < 2) {
                        $badge_text = 'Besok';
                        $badge_class = 'bg-warning text-dark';
                        $border_color = 'border-warning';
                    } else {
                        $badge_text = $days_left . ' Hari Lagi';
                        $badge_class = 'bg-success-subtle text-success-emphasis';
                    }
                    ?>

                    <div class="col-xs-12 col-md-8 col-lg-8">
                        <div class="panel">
                            <div class="row no-padding margin-3">
                                <div class="col-sm-3 col-lg-12">
                                    <h4 class="mb-4 fw-bold "><?= esc($task['nama_tugas']); ?><span class="badge rounded pull-right <?= $badge_class; ?>"><?= $badge_text; ?></span></h4>
                                    <i class="bi bi-clock me-1 glyphicon glyphicon-time"></i>
                                    <b><?= $deadline->format('l, j F Y'); ?></b>
                                    <?php if (session()->get('role') === 'mahasiswa'): ?>
                                        <a href="<?= base_url('task/upload/' . $task['id_task']); ?>" class="btn btn-success btn-sm pull-right">Kerjakan</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->include('Template/footer'); ?>