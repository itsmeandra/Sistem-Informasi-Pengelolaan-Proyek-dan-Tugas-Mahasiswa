<h4>Seluruh Proyek Aktif</h4>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Proyek</th>
            <th>Dibuat Oleh</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($projects as $p): ?>
            <tr>
                <td><?= esc($p['nama_project']) ?></td>
                <td><?= esc($p['created_by']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>