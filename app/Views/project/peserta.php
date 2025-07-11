<?= $this->include('Template/header'); ?>
<?= $this->include('Template/sidebar'); ?>

<!-- <div class="container mt-4">
    <h3>Daftar Peserta Proyek</h3>
    <ul class="list-group">
        <?php foreach ($peserta as $mhs): ?>
            <li class="list-group-item"><?= esc($mhs['nama']); ?> - <?= esc($mhs['username']); ?></li>
        <?php endforeach; ?>
    </ul>
</div> -->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li>Anggota Project</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Daftar Anggota</h3>
                    <table data-toggle="table" id="table-style" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
                        <!-- <table class="table table-striped table-bordered"> -->
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">NIM Mahasiswa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($peserta as $mhs):
                            ?>
                                <tr>
                                    <td data-sortable="true"><?= $no = $no + 1; ?></td>
                                    <td data-sortable="true"><?= $mhs['nama']; ?></td>
                                    <td data-sortable="true"><?= $mhs['username']; ?></td>
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