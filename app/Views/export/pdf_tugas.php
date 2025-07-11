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
    <h3>Daftar Tugas</h3>
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
            <?php $no = 1;
            foreach ($tasks as $t): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $t['nama_tugas']; ?></td>
                    <td><?= $t['deskripsi_tugas']; ?></td>
                    <td><?= $t['deadline']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>