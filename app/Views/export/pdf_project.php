<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
        }
    </style>
</head>

<body>
    <h3>Daftar Proyek</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Proyek</th>
                <th>Deskripsi</th>
                <th>Deadline</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($projects as $p): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $p['judul']; ?></td>
                    <td><?= $p['deskripsi']; ?></td>
                    <td><?= $p['deadline']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>