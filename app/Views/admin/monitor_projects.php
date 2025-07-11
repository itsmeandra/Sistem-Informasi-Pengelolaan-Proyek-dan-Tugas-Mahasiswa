<?= $this->include('Template/header'); ?>
<?= $this->include('Template/sidebar_admin'); ?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">Monitoring Project</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3>Monitoring Project</h3>
                        <div>
                            <a href="<?= base_url('admin/report/rekap'); ?>" class="btn btn-danger btn-sm">📄 Export PDF</a>
                            <!-- <a href="<?= base_url('admin/report/rekap-excel'); ?>" class="btn btn-success btn-sm">📊 Export Excel</a> -->
                        </div>
                    </div>
                    <hr />

                    <table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-pagination="true" data-sort-name="dibuat" data-sort-order="desc">
                        <thead>
                            <tr>
                                <th data-sortable="true">#</th>
                                <th data-sortable="true">Nama Project</th>
                                <th data-sortable="true">Deskripsi</th>
                                <th data-sortable="true">Dosen</th>
                                <!-- <th data-sortable="true" data-field="dibuat">Deadline</th> -->
                                <!-- <th>Opsi</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($projects)): ?>
                                <?php foreach ($projects as $index => $p): ?>
                                    <tr>
                                        <td><?= $index + 1; ?></td>
                                        <td><?= esc($p['judul']); ?></td>
                                        <td><?= esc($p['deskripsi']); ?></td>
                                        <td><?= esc($p['nama_dosen']); ?></td>

                                        <!-- <td>
                                            <a href="<?= base_url('project/detail/' . $p['id_project']); ?>" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-eye-open"></span> Detail</a>
                                        </td> -->
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada proyek untuk dimonitor.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function doDelete(idDelete) {
        swal({
                title: "Yakin Hapus Proyek?",
                text: "Data ini akan terhapus secara permanen!",
                icon: "warning",
                buttons: true,
                dangerMode: false,
            })
            .then((ok) => {
                if (ok) {
                    window.location.href = '<?= base_url(); ?>project/delete/' + idDelete;
                } else {
                    $(this).removeAttr('disabled')
                }
            });
    }
</script>
<?= $this->include('Template/footer'); ?>