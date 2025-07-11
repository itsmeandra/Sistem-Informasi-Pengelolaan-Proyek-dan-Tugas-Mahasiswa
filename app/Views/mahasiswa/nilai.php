<?= $this->include('Template/header'); ?>
<?= $this->include('Template/sidebar'); ?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Nilai Tugas Saya</h3>

                    <?php if (empty($nilaiList)): ?>
                        <div class="alert alert-warning">Belum ada tugas yang dikumpulkan.</div>
                    <?php else: ?>
                        <table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
                            <thead>
                                <tr>
                                    <th data-sortable="true">Nama Tugas</th>
                                    <th data-sortable="true">Deadline</th>
                                    <th data-sortable="true">Upload</th>
                                    <th data-sortable="true">Status</th>
                                    <th data-sortable="true">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 0;
                                foreach ($nilaiList as $n): ?>
                                    <tr>
                                        <td><?= esc($n['nama_tugas']); ?></td>
                                        <td><?= esc($n['deadline']); ?></td>
                                        <td><?= esc($n['tgl_upload']); ?></td>
                                        <td>
                                            <?php if ($n['status'] === 'Sudah Dinilai'): ?>
                                                <span class="label label-success">✅ Sudah Dinilai</span>
                                            <?php else: ?>
                                                <span class="label label-warning">⏳ Belum Dinilai</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?= $n['nilai'] !== null ? esc($n['nilai']) : '-' ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->include('Template/footer'); ?>