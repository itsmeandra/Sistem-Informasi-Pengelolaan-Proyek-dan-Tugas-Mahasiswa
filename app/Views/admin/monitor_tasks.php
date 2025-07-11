<?= $this->include('Template/header'); ?>
<?= $this->include('Template/sidebar_admin'); ?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">Monitoring Tugas</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3>📄 Monitoring Tugas</h3>
                        <div>
                            <!-- <a href="#" class="btn btn-danger btn-sm">Export PDF</a>
                            <a href="#" class="btn btn-success btn-sm">Export Excel</a> -->
                        </div>
                    </div>
                    <hr />

                    <form method="get" class="form-inline mb-3">
                        <div class="form-group">
                            <label for="project" class="mr-2">Filter Proyek:</label>
                            <select name="project" id="project" class="form-control" style="width: 300px;">
                                <option value="">-- Semua Proyek --</option>
                                <?php foreach ($projects as $proj): ?>
                                    <option value="<?= $proj['id_project']; ?>" <?= ($filter ?? '') == $proj['id_project'] ? 'selected' : ''; ?>>
                                        <?= esc($proj['judul']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>

                    <table data-toggle="table" data-show-refresh="true" data-search="true" data-pagination="true">
                        <thead>
                            <tr>
                                <th data-sortable="true">#</th>
                                <th data-sortable="true">Nama Project</th>
                                <th data-sortable="true">Nama Tugas</th>
                                <th data-sortable="true">Deadline</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($tasks)): ?>
                                <?php
                                foreach ($tasks as $index => $t): ?>
                                    <tr>
                                        <td><?= $index + 1; ?></td>
                                        <td><?= esc($proj['judul'] ?? 'N/A'); ?></td>
                                        <td><?= esc($t['nama_tugas']); ?></td>
                                        <td><?= date('d F Y', strtotime($t['deadline'])); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Tidak ada data tugas yang cocok dengan filter.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <h3>📄 Monitoring Tugas</h3>

<form method="get" class="form-inline mb-2">
    <select name="project" class="form-control">
        <option value="">-- Semua Proyek --</option>
        <?php foreach ($projects as $proj): ?>
            <option value="<?= $proj['id_project']; ?>" <?= $filter == $proj['id_project'] ? 'selected' : ''; ?>>
                <?= esc($proj['judul']); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <button class="btn btn-primary btn-sm">Filter</button>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Proyek</th>
            <th>Nama Tugas</th>
            <th>Deadline</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tasks as $t): ?>
            <tr>
                <td><?= esc($t['nama_project'] ?? ''); ?></td>
                <td><?= esc($t['nama_tugas']); ?></td>
                <td><?= esc($t['deadline']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table> -->

<?= $this->include('Template/footer'); ?>