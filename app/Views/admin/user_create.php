<?= $this->include('Template/header'); ?>
<?= $this->include('Template/sidebar_admin'); ?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <?php
    $roleTitle = ($defaultRole == 'dosen') ? 'Dosen' : 'Mahasiswa';
    ?>
    <!-- Breadcrumb Navigasi -->
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin/dashboard'); ?>"><span class="glyphicon glyphicon-home"></span></a></li>
            <li><a href="<?= base_url('admin/users?role=' . $defaultRole); ?>">Data <?= $roleTitle; ?></a></li>
            <li class="active">Tambah User</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Tambah User Baru</h3>
                    <hr>
                    <form action="<?= base_url('admin/users/store'); ?>" method="post">

                        <div class="form-group col-md-6">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" required>
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label>NIM / NIP</label>
                            <input type="text" name="username" class="form-control" placeholder="Masukkan NIM atau NIP" required>
                        </div>
                        <div style="clear:both;"></div>

                        <!-- <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="contoh@email.com" required>
                        </div>
                        <div style="clear:both;"></div> -->

                        <div class="form-group col-md-6">
                            <label>Role</label>
                            <select name="role" class="form-control">
                                <option value="dosen" <?= $defaultRole == 'dosen' ? 'selected' : ''; ?>>Dosen</option>
                                <option value="mahasiswa" <?= $defaultRole == 'mahasiswa' ? 'selected' : ''; ?>>Mahasiswa</option>
                            </select>
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="<?= base_url('admin/users?role=' . $defaultRole); ?>" class="btn btn-danger">Batal</a>
                        </div>
                        <div style="clear:both;"></div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->include('Template/footer'); ?>