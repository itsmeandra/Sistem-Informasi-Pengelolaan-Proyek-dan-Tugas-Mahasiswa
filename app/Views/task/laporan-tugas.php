<?= $this->include('Template/header'); ?>
<?= $this->include('Template/sidebar'); ?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li>Laporan Tugas</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Laporan Tugas Mahasiswa</h3>
                    <hr>
                    <!-- <a href="<?= base_url('export/pdf-laporan-tugas'); ?>" class="btn btn-danger btn-sm">📄 Export PDF</a>
                    <a href="<?= base_url('export/excel-laporan-tugas'); ?>" class="btn btn-success btn-sm">📊 Export Excel</a> -->
                    <table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
                        <thead>
                            <tr>
                                <th data-sortable="true">#</th>
                                <th data-sortable="true">Mahasiswa</th>
                                <th data-sortable="true">Nim</th>
                                <th data-sortable="true">Tugas</th>
                                <th data-sortable="true">Deadline</th>
                                <th data-sortable="true">File</th>
                                <th data-sortable="true">Status</th>
                                <th data-sortable="true">Nilai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($laporan as $row):
                            ?>
                                <tr>
                                    <td data-sortable="true"><?= $no = $no + 1; ?></td>
                                    <td data-sortable="true"><?= esc($row['nama_mahasiswa']); ?></td>
                                    <td data-sortable="true"><?= esc($row['nim']); ?></td>
                                    <td data-sortable="true"><?= esc($row['nama_tugas']); ?></td>
                                    <td data-sortable="true"><?= esc($row['deadline']); ?></td>
                                    <td>
                                        <a href="<?= base_url('uploads/' . $row['file']); ?>" target="_blank" class="btn btn-info btn-sm">Download</a>
                                    </td>
                                    <td>
                                        <?php if ($row['nilai'] !== null): ?>
                                            <span class="label label-success">Sudah Dinilai</span>
                                        <?php else: ?>
                                            <span class="label label-warning">Belum Dinilai</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $row['nilai'] ?? '-'; ?></td>
                                    <td>
                                        <a href="<?= base_url('task/nilai/' . $row['id_submission']); ?>" class="btn btn-sm btn-primary">
                                            <?= $row['nilai'] !== null ? 'Edit Nilai' : 'Beri Nilai'; ?>
                                        </a>
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
<?= $this->include('Template/footer'); ?>