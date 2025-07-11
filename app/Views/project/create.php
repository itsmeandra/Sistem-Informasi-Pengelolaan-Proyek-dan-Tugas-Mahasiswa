<?= $this->include('Template/header'); ?>
<?= $this->include('Template/sidebar'); ?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li>Project</li>
            <li class="active">Buat Proyek</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Buat Proyek</h3>
                    <form action="<?php echo base_url('project/store'); ?>" method="post">
                        <div class="form-group col-md-6">
                            <label>Judul Proyek</label>
                            <input type="text" class="form-control" name="judul" placeholder="Masukkan Judul Proyek" required>
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" placeholder="Berikan deskripsi pada proyek" required></textarea>
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