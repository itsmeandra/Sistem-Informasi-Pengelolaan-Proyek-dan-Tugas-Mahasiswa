<?= $this->include('Template/header'); ?>
<?= $this->include('Template/sidebar'); ?>
<div class="col-sm-9 col-sm-offset-3 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">Daftar Proyek</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Statistik Proyek</h3>
                    <ul class="list-group">
                        <li class="list-group-item">Total Tugas: <?= $stat['total_tugas']; ?></li>
                        <li class="list-group-item">Total Laporan: <?= $stat['total_laporan']; ?></li>
                        <li class="list-group-item">Rata-rata Nilai: <?= $stat['rata_rata_nilai']; ?></li>
                    </ul>
                    <!-- <table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
                        <thead>
                            <tr>
                                <th data-sortable="true">#</th>
                                <th data-sortable="true">Judul</th>
                                <th data-sortable="true">Deadline</th>
                            </tr>
                        </thead>
                    </table> -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?= $this->include('Template/footer'); ?>