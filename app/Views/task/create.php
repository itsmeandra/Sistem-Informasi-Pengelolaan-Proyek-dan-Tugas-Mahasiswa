<?= $this->include('Template/header'); ?>
<?= $this->include('Template/sidebar'); ?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li>Project</li>
            <li>Tugas</li>
            <li>Buat Tugas</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Buat Tugas</h3>
                    <form action="<?= base_url('task/store'); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_project" value="<?= $id_project; ?>">
                        <div class="form-group col-md-6">
                            <label>Judul Tugas</label>
                            <input type="text" name="nama_tugas" class="form-control" placeholder="Masukan Judul Tugas" required>
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi_tugas" class="form-control" placeholder="Berikan Deskripsi Pada Tugas" required></textarea>
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label for="file_tugas">Upload File Tugas</label>
                            <input type="file" name="file_tugas" class="form-control">
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label>Deadline</label>
                            <input type="date" name="deadline" class="form-control" required>
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="<?= base_url('project'); ?>" class="btn btn-danger">Batal</a>
                        </div>
                        <div style="clear:both;"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->include('Template/footer'); ?>