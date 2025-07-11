<?= $this->include('Template/header'); ?>
<?= $this->include('Template/sidebar_admin'); ?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <?php
    // Menentukan judul berdasarkan role user untuk digunakan di breadcrumb
    $roleTitle = ($user['role'] == 'dosen') ? 'Dosen' : 'Mahasiswa';
    ?>
    <!-- Breadcrumb Navigasi -->
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin/dashboard'); ?>"><span class="glyphicon glyphicon-home"></span></a></li>
            <li><a href="<?= base_url('admin/users?role=' . $user['role']); ?>">Data <?= $roleTitle; ?></a></li>
            <li class="active">Edit User</li>
        </ol>
    </div>

    <!-- Panel Form -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Edit Data User</h3>
                    <hr>
                    <form action="<?= base_url('admin/users/update/' . $user['id_user']); ?>" method="post">

                        <div class="form-group col-md-6">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" value="<?= esc($user['nama']); ?>" class="form-control" placeholder="Masukkan nama lengkap" required>
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label>NIM / NIP</label>
                            <input type="text" name="username" value="<?= esc($user['username']); ?>" class="form-control" placeholder="Masukkan NIM atau NIP" required>
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label>Role</label>
                            <select name="role" class="form-control">
                                <option value="dosen" <?= $user['role'] == 'dosen' ? 'selected' : ''; ?>>Dosen</option>
                                <option value="mahasiswa" <?= $user['role'] == 'mahasiswa' ? 'selected' : ''; ?>>Mahasiswa</option>
                            </select>
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label>Password Baru</label>
                            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah">
                            <small class="text-muted">Isi kolom ini hanya jika Anda ingin mengganti password.</small>
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-primary">Update Data</button>
                            <a href="<?= base_url('admin/users?role=' . $user['role']); ?>" class="btn btn-danger">Batal</a>
                        </div>
                        <div style="clear:both;"></div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->include('Template/footer'); ?>