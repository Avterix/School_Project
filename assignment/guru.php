<?php
include 'koneksi.php';
include 'header.php';

$query = mysqli_query($koneksi, "
    SELECT guru.*, users.username 
    FROM guru 
    LEFT JOIN users ON guru.user_id = users.id
");
?>

<h2>Data Guru</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>NIP</th>
            <th>Nama Guru</th>
            <th>Jenis Kelamin</th>
            <th>Akun Username</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($query)) : ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= htmlspecialchars($row['nip']); ?></td>
            <td><?= htmlspecialchars($row['nama']); ?></td>
            <td><?= $row['jenis_kelamin'] == 'L' ? 'Laki-Laki' : 'Perempuan'; ?></td>
            <td><?= $row['username'] ? htmlspecialchars($row['username']) : '<em>Tidak Ada Akun</em>'; ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include 'footer.php'; ?>