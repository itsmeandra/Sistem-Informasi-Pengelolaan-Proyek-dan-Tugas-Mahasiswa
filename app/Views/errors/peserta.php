<?= $this->include('Template/header'); ?>
<?= $this->include('Template/sidebar'); ?>

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
                    <h3>Anggota Project</h3>
                    <table class="table">
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

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <!-- <ul class="list-group">
                            <?php foreach ($peserta as $mhs): ?>
                                <li class="list-group-item"><?= esc($mhs['nama']); ?> - <?= esc($mhs['username']); ?></li>
                            <?php endforeach; ?>
                        </ul> -->
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('Template/footer'); ?>