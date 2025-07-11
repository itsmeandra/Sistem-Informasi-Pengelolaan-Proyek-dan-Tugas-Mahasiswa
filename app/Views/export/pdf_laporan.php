<!DOCTYPE html>
<html>

<head>
    <title>Laporan Tugas Mahasiswa</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Laporan Tugas Mahasiswa</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Mahasiswa</th>
                <th>NIM</th>
                <th>Tugas</th>
                <th>Deadline</th>
                <th>Status</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($submissions as $index => $sub): ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?= esc($sub['nama_mahasiswa']); ?></td>
                    <td><?= esc($sub['nim']); ?></td>
                    <td><?= esc($sub['nama_tugas']); ?></td>
                    <td><?= esc($sub['deadline']); ?></td>
                    <td><?= esc($sub['status']); ?></td>
                    <td><?= esc($sub['nilai']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>