<?= $this->include('Template/header'); ?>
<?= $this->include('Template/sidebar_admin'); ?>
<!-- <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <h3>Data <?= ($users[0]['role'] ?? '') === 'mahasiswa' ? 'Mahasiswa' : 'Dosen'; ?></h3>
    <a href="<?= base_url('admin/users/create?role=' . ($users[0]['role'] ?? 'mahasiswa')); ?>" class="btn btn-primary btn-sm">+ Tambah</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Nama</th>
                <th>NIM/NIP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $u): ?>
                <tr>
                    <td><?= esc($u['nama']); ?></td>
                    <td><?= esc($u['username']); ?></td>
                    <td>
                        <a href="<?= base_url('admin/users/edit/' . $u['id_user']); ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="<?= base_url('admin/users/delete/' . $u['id_user']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus user ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div> -->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <?php
    // Menentukan role dan judul halaman untuk membuat kode lebih rapi
    $role = ($users[0]['role'] ?? 'mahasiswa');
    $pageTitle = ($role === 'mahasiswa') ? 'Mahasiswa' : 'Dosen';
    ?>

    <!-- Breadcrumb Navigasi -->
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin/dashboard'); ?>"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">Data <?= $pageTitle; ?></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>
                        Daftar <?= $pageTitle; ?>
                        <a href="<?= base_url('admin/users/create?role=' . $role); ?>" class="btn btn-sm btn-primary pull-right">
                            <span class="glyphicon glyphicon-plus"></span> Tambah <?= $pageTitle; ?>
                        </a>
                    </h3>
                    <hr />

                    <table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="nama" data-sort-order="asc" class="mt-3">
                        <thead>
                            <tr>
                                <th data-sortable="true" data-field="no">#</th>
                                <th data-sortable="true" data-field="nama">Nama</th>
                                <th data-sortable="true" data-field="id_number"><?= ($role === 'mahasiswa') ? 'NIM' : 'NIP'; ?></th>
                                <th data-field="aksi">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>
                            <?php foreach ($users as $u): ?>
                                <tr>
                                    <td><?= ++$no; ?></td>
                                    <td><?= esc($u['nama']); ?></td>
                                    <td><?= esc($u['username']); ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/users/edit/' . $u['id_user']); ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                                        <a href="<?= base_url('admin/users/delete/' . $u['id_user']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus user ini?')"><span class="glyphicon glyphicon-trash"></span> Hapus</a>
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