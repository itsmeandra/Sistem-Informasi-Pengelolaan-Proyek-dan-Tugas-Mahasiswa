<?= $this->include('Template/header'); ?>
<?= $this->include('Template/sidebar'); ?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">Project</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Daftar Proyek Anda
                        <a href="<?= base_url('project/create'); ?>" button type="button" class="btn btn-sm btn-primary pull-right">
                            <span class="glyphicon glyphicon-plus"></span> Tambah Proyek
                        </a>
                    </h3>
                    <hr />
                    <a href="<?= base_url('export/pdf-project'); ?>" class="btn btn-danger btn-sm">📄 Export PDF</a>
                    <a href="<?= base_url('export/excel-project'); ?>" class="btn btn-success btn-sm">📊 Export Excel</a>
                    <table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
                        <thead>
                            <tr>
                                <th data-sortable="true">#</th>
                                <th data-sortable="true">Judul</th>
                                <th data-sortable="true">Deskripsi</th>
                                <th data-sortable="true">Deadline</th>
                                <th>Opsi</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($projects as $proj): ?>
                                <tr>
                                    <td data-sortable="true"><?= $no = (isset($no) ? $no : 0) + 1; ?></td>
                                    <td data-sortable="true"><?= esc($proj['judul']); ?></td>
                                    <td data-sortable="true"><?= esc($proj['deskripsi']); ?></td>
                                    <td data-sortable="true"><?= esc($proj['deadline']); ?></td>
                                    <td data-sortable="true">
                                        <a href="<?= base_url('project/edit/' . esc($proj['id_project'])); ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                                        <a href="#" class="btn btn-danger btn-sm" onclick="doDelete(<?= esc($proj['id_project']); ?>);"><span class="glyphicon glyphicon-trash"></span> Hapus</a>
                                        <a href="<?= base_url('task/' . esc($proj['id_project'])); ?>" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-list-alt"></span> Lihat Tugas</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
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