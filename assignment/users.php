<?php
include 'koneksi.php';
include 'header.php';

$query = mysqli_query($koneksi, "SELECT * FROM users ORDER BY id DESC");
?>

<h2>Data Users</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Role</th>
            <th>Waktu Dibuat</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($query)) : ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= htmlspecialchars($row['username']); ?></td>
            <td><?= $row['role']; ?></td>
            <td><?= $row['created_at']; ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include 'footer.php'; ?>