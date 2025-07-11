<?= $this->include('Template/header'); ?>
<?= $this->include('Template/sidebar'); ?>
<!-- <div class="container mt-4">
    <h3>Edit Proyek</h3>
    <form action="<?= base_url('project/update/' . $project['id_project']); ?>" method="post">
        <div class="mb-3">
            <label>Judul Proyek</label>
            <input type="text" name="judul" class="form-control" value="<?= esc($project['judul']); ?>" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required><?= esc($project['deskripsi']); ?></textarea>
        </div>
        <div class="mb-3">
            <label>Deadline</label>
            <input type="date" name="deadline" class="form-control" value="<?= esc($project['deadline']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?= base_url('project'); ?>" class="btn btn-secondary">Batal</a>
    </form>
</div> -->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li>Project</li>
            <li class="active">Edit Proyek</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Edit Proyek</h3>
                    <form action="<?= base_url('project/update/' . $project['id_project']); ?>" method="post">
                        <div class="form-group col-md-6">
                            <label>Judul Proyek</label>
                            <input type="text" name="judul" class="form-control" value="<?= esc($project['judul']); ?>" required>
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" required><?= esc($project['deskripsi']); ?></textarea>
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label>Deadline</label>
                            <input type="date" name="deadline" class="form-control" value="<?= esc($project['deadline']); ?>" required>
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-primary">Update</button>
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