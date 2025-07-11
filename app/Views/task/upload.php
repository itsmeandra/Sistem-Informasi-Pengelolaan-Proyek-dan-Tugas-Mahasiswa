<?= $this->include('Template/header'); ?>
<?= $this->include('Template/sidebar'); ?>
<!-- <div class="container mt-4">
    <h3>Upload Laporan Tugas</h3>
    <form action="<?= base_url('task/upload'); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_task" value="<?= $id_task; ?>">
        <div class="mb-3">
            <label>File Laporan (PDF/DOCX)</label>
            <input type="file" name="file_laporan" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Upload</button>
        <a href="<?= base_url('join'); ?>" class="btn btn-secondary">Batal</a>
    </form>
</div> -->

<div class="col-sm-9 col-sm-offset-3 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li>Gabung Project</li>
            <li class="active">Upload</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Upload Laporan Tugas</h3>
                    <form action="<?php echo base_url('/task/upload'); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_task" value="<?= $id_task; ?>">
                        <div class="form-group col-md-6">
                            <label for="file_laporan">File Laporan (PDF/DOCX)</label>
                            <input type="file" class="form-control" name="file_laporan" required>
                        </div>
                        <div style="clear:both;"></div>
                        <?php
                        $idProject = session()->get('active_project_id');
                        ?>
                        <?php if ($idProject): ?>
                            <div class="form-group col-md-6">
                                <button type="submit" class="btn btn-success">Upload</button>
                                <a href="<?= base_url('task/' . $idProject); ?>" class="btn btn-danger">Batal</a>
                            </div>
                        <?php endif; ?>
                        <div style="clear:both;"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->include('Template/footer'); ?>