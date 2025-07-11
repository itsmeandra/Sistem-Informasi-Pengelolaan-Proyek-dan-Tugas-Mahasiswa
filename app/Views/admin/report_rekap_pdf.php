<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px
        }
    </style>
</head>

<body>
    <h2 align="center">Rekap Proyek & Tugas</h2>
    <?php foreach ($projects as $p): ?>
        <b><?= esc($p['judul']); ?></b> - Dosen: <?= esc($p['dosen']); ?><br>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Tugas</th>
                    <th>Deskripsi</th>
                    <th>Deadline</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($p['tugas'])): ?>
                    <tr>
                        <td colspan="3" align="center">Belum ada tugas</td>
                    </tr>
                    <?php else: $n = 1;
                    foreach ($p['tugas'] as $t): ?>
                        <tr>
                            <td><?= $n++; ?></td>
                            <td><?= esc($t['nama_tugas']); ?></td>
                            <td><?= esc($t['deadline']); ?></td>
                        </tr>
                <?php endforeach;
                endif; ?>
            </tbody>
        </table><br>
    <?php endforeach; ?>
</body>

</html>