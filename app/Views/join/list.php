<?= $this->include('Template/header'); ?>
<?= $this->include('Template/sidebar'); ?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">Gabung Project</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Daftar Project</h3>
                    <hr />
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
                                        <a href="<?= base_url('join/' . $proj['id_project']); ?>" class="btn btn-primary btn-sm">Gabung</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                </div>
            </div>
        </div>
    </div>
</div><?= $this->include('Template/footer'); ?>