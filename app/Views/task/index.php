<?= $this->include('Template/header'); ?>
<?= $this->include('Template/sidebar'); ?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li>Project</li>
            <li>Tugas</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Daftar Tugas Proyek
                        <?php if (session()->get('role') == 'dosen'): ?>
                            <a href="<?= base_url('task/create/' . $id_project); ?>" class="btn btn-primary mb-3 pull-right">Buat Tugas</a>
                        <?php endif; ?>
                    </h3>
                    <hr>
                    <a href="<?= base_url('export/pdf-tugas/' . $id_project); ?>" class="btn btn-danger btn-sm">📄 PDF Tugas</a>
                    <a href="<?= base_url('export/excel-tugas/' . $id_project); ?>" class="btn btn-success btn-sm">📊 Excel Tugas</a>
                    <table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
                        <thead>
                            <tr>
                                <th data-sortable="true">#</th>
                                <th data-sortable="true">Judul</th>
                                <th data-sortable="true">Deskripsi</th>
                                <th data-sortable="true">Deadline</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $role = session()->get('role');
                            $no = 0;
                            foreach ($tasks as $task) {
                            ?>
                                <tr>
                                    <td data-sortable="true"><?= $no = $no + 1; ?></td>
                                    <td data-sortable="true"><?= $task['nama_tugas']; ?></td>
                                    <td data-sortable="true"><?= $task['deskripsi_tugas']; ?></td>
                                    <td data-sortable="true"><?= $task['deadline']; ?></td>
                                    <td data-sortable="true">
                                        <?php if ($role == 'dosen'): ?>
                                            <!-- <a href="<?= base_url('task/edit/' . $task['id_task']); ?>" class="btn btn-info btn-sm">Edit</a> -->
                                            <!-- <a href="<?= base_url('task/delete/' . $task['id_task']); ?>" class="btn btn-danger btn-sm">Hapus</a> -->
                                            <a href="<?= base_url('task/nilai/' . $task['id_task']); ?>" class="btn btn-success btn-sm">Beri Nilai</a>
                                        <?php elseif ($role == 'mahasiswa'): ?>
                                            <a href="<?= base_url('uploads/tugas/' . $task['file_tugas']); ?>" class="btn btn-primary btn-sm" download>Unduh</a>
                                            <a href="<?= base_url('task/upload/' . $task['id_task']); ?>" class="btn btn-success btn-sm">Kerjakan</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>

                    <!-- <a href="<?= base_url('project/'); ?>" class="btn btn-secondary">Kembali</a> -->
                    <!-- <?php if (session()->get('role') == 'dosen'): ?>
                        <a href="<?= base_url('task/create/' . $id_project); ?>" class="btn btn-primary mb-3">+ Tambah Tugas</a>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                    <?php endif; ?>

                    <ul class="list-group">
                        <?php foreach ($tasks as $task): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="form-group col-md-6">
                                    <?= esc($task['nama_tugas']); ?> - Deadline: <?= esc($task['deadline']); ?>
                                </div>
                                <div style="clear:both;"></div>

                                <div class="form-group col-md-6">
                                    <?php if (session()->get('role') == 'dosen'): ?>
                                        <a href="<?= base_url('task/nilai/' . $task['id_task']); ?>" class="btn btn-success btn-sm">Beri Nilai</a>
                                        <a href="<?= base_url('task/edit/' . $task['id_task']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <?php endif; ?>

                                    <?php if (session()->get('role') == 'mahasiswa'): ?>
                                        <a href="#" class="btn btn-primary btn-sm">Unduh Tugas</a>
                                        <a href="<?= base_url('task/upload/' . $task['id_task']); ?>" class="btn btn-success btn-sm">Kerjakan Tugas</a>
                                    <?php endif; ?>
                                </div>
                                <div style="clear:both;"></div>
                            </li>
                        <?php endforeach; ?> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function doDelete(idDelete) {
        swal({
                title: "Hapus Data Admin?",
                text: "Data ini akan terhapus secara permanen!!",
                icon: "warning",
                buttons: true,
                dangerMode: false,
            })
            .then((ok) => {
                if (ok) {
                    window.location.href = "<?= base_url(); ?>/admin/hapus-data-admin/" + idDelete;
                } else {
                    $(this).removeAttr("disabled");
                }
            });
    }
</script>
<?= $this->include('Template/footer'); ?>