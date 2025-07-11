<a href="<?= base_url('admin/users/create'); ?>" class="btn btn-primary">+ Tambah User</a>
<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Username</th>
            <th>Role</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $u): ?>
            <tr>
                <td><?= esc($u['nama']); ?></td>
                <td><?= esc($u['username']); ?></td>
                <td><?= esc($u['role']); ?></td>
                <td><?= esc($u['email']); ?></td>
                <td>
                    <a href="<?= base_url('admin/users/edit/' . $u['id_user']); ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="<?= base_url('admin/users/delete/' . $u['id_user']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus user?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>