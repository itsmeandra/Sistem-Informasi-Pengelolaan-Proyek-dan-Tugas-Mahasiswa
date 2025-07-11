<?= $this->include('Template/header'); ?>
<?= $this->include('Template/sidebar'); ?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <h3>Input Nilai</h3>
    <form action="<?= base_url('task/nilai'); ?>" method="post">
        <input type="hidden" name="id_submission" value="<?= $id_submission; ?>">
        <div class="mb-3">
            <label>Nilai</label>
            <input type="number" name="nilai" min="0" max="100" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="komentar" class="form-label">Komentar (Opsional)</label>
            <textarea name="komentar" id="komentar" class="form-control" rows="4" placeholder="Berikan masukan atau feedback untuk mahasiswa..."></textarea>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="javascript:history.back()" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<?= $this->include('Template/footer'); ?>