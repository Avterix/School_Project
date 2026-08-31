<?php
// 1. AKTIFKAN PELACAK ERROR (Biar kalau ada masalah langsung kelihatan di layar)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2. HUBUNGKAN KONEKSI
include 'koneksi.php';
$pesan = "";

// 3. PROSES INPUT DATA BERDASARKAN FORM YANG DIKIRIM
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_user'])) {
        $id = $_POST['id']; 
        $user = $_POST['username']; 
        $pass = password_hash($_POST['password'], PASSWORD_DEFAULT); 
        $role = $_POST['role'];
        
        $sql = "INSERT INTO users (id, username, password, role, created_at) VALUES ('$id', '$user', '$pass', '$role', NOW())";
        $pesan = $koneksi->query($sql) ? "<p class='success'>User berhasil ditambah!</p>" : "<p class='error'>Gagal: ".$koneksi->error."</p>";
    }
    elseif (isset($_POST['add_guru'])) {
        $id = $_POST['id']; 
        $nip = $_POST['nip']; 
        $nama = $_POST['nama']; 
        $jk = $_POST['jenis_kelamin']; 
        $uid = empty($_POST['user_id']) ? "NULL" : "'".$_POST['user_id']."'";
        
        $sql = "INSERT INTO guru (id, nip, nama, jenis_kelamin, user_id) VALUES ('$id', '$nip', '$nama', '$jk', $uid)";
        $pesan = $koneksi->query($sql) ? "<p class='success'>Guru berhasil ditambah!</p>" : "<p class='error'>Gagal: ".$koneksi->error."</p>";
    }
    elseif (isset($_POST['add_siswa'])) {
        $id = $_POST['id']; 
        $nis = $_POST['nis']; 
        $nama = $_POST['nama']; 
        $kelas = $_POST['kelas']; 
        $jk = $_POST['jenis_kelamin']; 
        $uid = empty($_POST['user_id']) ? "NULL" : "'".$_POST['user_id']."'";
        
        // Perbaikan bug tanda petik pada '$jk' di baris ini
        $sql = "INSERT INTO siswa (id, nis, nama, kelas, jenis_kelamin, user_id) VALUES ('$id', '$nis', '$nama', '$kelas', '$jk', $uid)";
        $pesan = $koneksi->query($sql) ? "<p class='success'>Siswa berhasil ditambah!</p>" : "<p class='error'>Gagal: ".$koneksi->error."</p>";
    }
    elseif (isset($_POST['add_mapel'])) {
        $id = $_POST['id']; 
        $kode = $_POST['kode_mapel']; 
        $nama = $_POST['nama_mapel']; 
        $gid = empty($_POST['guru_id']) ? "NULL" : "'".$_POST['guru_id']."'";
        
        $sql = "INSERT INTO mapel (id, kode_mapel, nama_mapel, guru_id) VALUES ('$id', '$kode', '$nama', $gid)";
        $pesan = $koneksi->query($sql) ? "<p class='success'>Mapel berhasil ditambah!</p>" : "<p class='error'>Gagal: ".$koneksi->error."</p>";
    }
    elseif (isset($_POST['add_nilai'])) {
        $id = $_POST['id']; 
        $sid = $_POST['siswa_id']; 
        $mid = $_POST['mapel_id']; 
        $kkm = $_POST['nilai_kkm']; 
        $p_nget = $_POST['nilai_pengetahuan']; 
        $p_ter = $_POST['nilai_keterampilan']; 
        $ket = $_POST['keterangan'];
        
        $sql = "INSERT INTO nilai_rapor (id, siswa_id, mapel_id, nilai_kkm, nilai_pengetahuan, nilai_keterampilan, keterangan) VALUES ('$id', '$sid', '$mid', '$kkm', '$p_nget', '$p_ter', '$ket')";
        $pesan = $koneksi->query($sql) ? "<p class='success'>Nilai Rapor berhasil ditambah!</p>" : "<p class='error'>Gagal: ".$koneksi->error."</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Uji Database SIACAD SMK</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; margin: 30px; background-color: #f8f9fa; }
        .success { padding: 10px; background: #d4edda; color: #155724; border-radius: 4px; }
        .error { padding: 10px; background: #f8d7da; color: #721c24; border-radius: 4px; }
        .tab-menu { display: flex; border-bottom: 2px solid #dee2e6; margin-bottom: 20px; }
        .tab-btn { padding: 10px 20px; border: none; background: none; cursor: pointer; font-size: 16px; font-weight: bold; color: #495057; transition: 0.2s; }
        .tab-btn:hover { color: #007bff; }
        .tab-btn.active { border-bottom: 3px solid #007bff; color: #007bff; }
        
        /* Animasi Tipis-Tipis untuk Tab Content */
        .tab-content { display: none; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .tab-content.active { 
            display: block; 
            animation: fadeInSlide 0.35s ease-out forwards;
        }

        @keyframes fadeInSlide {
            0% { opacity: 0; transform: translateY(8px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .grid { display: grid; grid-template-columns: 1fr 2fr; gap: 20px; }
        form { background: #f1f3f5; padding: 15px; border-radius: 6px; }
        .form-group { margin-bottom: 12px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px; }
        input, select { width: 100%; padding: 8px; border: 1px solid #ced4da; border-radius: 4px; box-sizing: border-box; }
        button { padding: 10px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; width: 100%; font-weight: bold; transition: 0.2s; }
        button:hover { background: #0056b3; }
        table { width: 100%; border-collapse: collapse; font-size: 14px; }
        table, th, td { border: 1px solid #dee2e6; padding: 10px; text-align: left; }
        th { background: #e9ecef; }
    </style>
</head>
<body>

    <h2>SIACAD SMK Database Tester Dashboard</h2>
    <?php echo $pesan; ?>

    <!-- Menu Tab Navigasi -->
    <div class="tab-menu">
        <button class="tab-btn active" onclick="openTab(event, 'tab-users')">1. Users</button>
        <button class="tab-btn" onclick="openTab(event, 'tab-guru')">2. Guru</button>
        <button class="tab-btn" onclick="openTab(event, 'tab-siswa')">3. Siswa</button>
        <button class="tab-btn" onclick="openTab(event, 'tab-mapel')">4. Mapel</button>
        <button class="tab-btn" onclick="openTab(event, 'tab-nilai')">5. Nilai Rapor</button>
    </div>

    <!-- ==================== TAB 1: USERS ==================== -->
    <div id="tab-users" class="tab-content active">
        <div class="grid">
            <form action="" method="POST">
                <h3>Input User Baru</h3>
                <div class="form-group"><label>ID User (Primary Key):</label><input type="number" name="id" required></div>
                <div class="form-group"><label>Username:</label><input type="text" name="username" required></div>
                <div class="form-group"><label>Password:</label><input type="password" name="password" required></div>
                <div class="form-group"><label>Role:</label>
                    <select name="role"><option value="admin">Admin</option><option value="guru">Guru</option><option value="siswa">Siswa</option></select>
                </div>
                <button type="submit" name="add_user">Simpan User</button>
            </form>
            <div>
                <h3>Data Tabel: users</h3>
                <table>
                    <tr><th>ID</th><th>Username</th><th>Role</th><th>Created At</th></tr>
                    <?php $q = $koneksi->query("SELECT * FROM users"); while($r = $q->fetch_assoc()) { echo "<tr><td>{$r['id']}</td><td>{$r['username']}</td><td>{$r['role']}</td><td>{$r['created_at']}</td></tr>"; } ?>
                </table>
            </div>
        </div>
    </div>

    <!-- ==================== TAB 2: GURU ==================== -->
    <div id="tab-guru" class="tab-content">
        <div class="grid">
            <form action="" method="POST">
                <h3>Input Guru Baru</h3>
                <div class="form-group"><label>ID Guru:</label><input type="number" name="id" required></div>
                <div class="form-group"><label>NIP:</label><input type="text" name="nip" required></div>
                <div class="form-group"><label>Nama Guru:</label><input type="text" name="nama" required></div>
                <div class="form-group"><label>Jenis Kelamin:</label>
                    <select name="jenis_kelamin"><option value="L">Laki-laki</option><option value="P">Perempuan</option></select>
                </div>
                <div class="form-group"><label>Relasi User ID (Opsional):</label><input type="number" name="user_id" placeholder="Boleh kosong"></div>
                <button type="submit" name="add_guru">Simpan Guru</button>
            </form>
            <div>
                <h3>Data Tabel: guru (JOIN users)</h3>
                <table>
                    <tr><th>ID Guru</th><th>NIP</th><th>Nama</th><th>JK</th><th>Akun Username</th></tr>
                    <?php $q = $koneksi->query("SELECT g.*, u.username FROM guru g LEFT JOIN users u ON g.user_id = u.id"); while($r = $q->fetch_assoc()) { echo "<tr><td>{$r['id']}</td><td>{$r['nip']}</td><td>{$r['nama']}</td><td>{$r['jenis_kelamin']}</td><td>".($r['username'] ?? '-')."</td></tr>"; } ?>
                </table>
            </div>
        </div>
    </div>

    <!-- ==================== TAB 3: SISWA ==================== -->
    <div id="tab-siswa" class="tab-content">
        <div class="grid">
            <form action="" method="POST">
                <h3>Input Siswa Baru</h3>
                <div class="form-group"><label>ID Siswa:</label><input type="number" name="id" required></div>
                <div class="form-group"><label>NIS:</label><input type="text" name="nis" required></div>
                <div class="form-group"><label>Nama Siswa:</label><input type="text" name="nama" required></div>
                <div class="form-group"><label>Kelas:</label><input type="text" name="kelas" required placeholder="Contoh: XII-RPL-1"></div>
                <div class="form-group"><label>Jenis Kelamin:</label>
                    <select name="jenis_kelamin"><option value="L">Laki-laki</option><option value="P">Perempuan</option></select>
                </div>
                <div class="form-group"><label>Relasi User ID (Opsional):</label><input type="number" name="user_id" placeholder="Boleh kosong"></div>
                <button type="submit" name="add_siswa">Simpan Siswa</button>
            </form>
            <div>
                <h3>Data Tabel: siswa (JOIN users)</h3>
                <table>
                    <tr><th>ID Siswa</th><th>NIS</th><th>Nama</th><th>Kelas</th><th>JK</th><th>Akun Username</th></tr>
                    <?php 
                    $q = $koneksi->query("SELECT s.*, u.username FROM siswa s LEFT JOIN users u ON s.user_id = u.id"); 
                    while($r = $q->fetch_assoc()) { 
                        echo "<tr><td>{$r['id']}</td><td>{$r['nis']}</td><td>{$r['nama']}</td><td>{$r['kelas']}</td><td>{$r['jenis_kelamin']}</td><td>".($r['username'] ?? '-')."</td></tr>"; 
                    } 
                    ?>
                </table>
            </div>
        </div>
    </div>

    <!-- ==================== TAB 4: MAPEL ==================== -->
    <div id="tab-mapel" class="tab-content">
        <div class="grid">
            <form action="" method="POST">
                <h3>Input Mapel Baru</h3>
                <div class="form-group"><label>ID Mapel:</label><input type="number" name="id" required></div>
                <div class="form-group"><label>Kode Mapel:</label><input type="text" name="kode_mapel" required></div>
                <div class="form-group"><label>Nama Mapel:</label><input type="text" name="nama_mapel" required></div>
                <div class="form-group"><label>Relasi Guru ID (Opsional):</label><input type="number" name="guru_id" placeholder="Boleh kosong"></div>
                <button type="submit" name="add_mapel">Simpan Mapel</button>
            </form>
            <div>
                <h3>Data Tabel: mapel (JOIN guru)</h3>
                <table>
                    <tr><th>ID Mapel</th><th>Kode Mapel</th><th>Nama Mapel</th><th>Nama Guru</th></tr>
                    <?php 
                    $q = $koneksi->query("SELECT m.*, g.nama FROM mapel m LEFT JOIN guru g ON m.guru_id = g.id"); 
                    while($r = $q->fetch_assoc()) { 
                        echo "<tr><td>{$r['id']}</td><td>{$r['kode_mapel']}</td><td>{$r['nama_mapel']}</td><td>".($r['nama'] ?? '-')."</td></tr>"; 
                    } 
                    ?>
                </table>
            </div>
        </div>
    </div>

    <!-- ==================== TAB 5: NILAI RAPOR ==================== -->
    <div id="tab-nilai" class="tab-content">
        <div class="grid">
            <form action="" method="POST">
                <h3>Input Nilai Rapor</h3>
                <div class="form-group"><label>ID Nilai:</label><input type="number" name="id" required></div>
                <div class="form-group"><label>ID Siswa:</label><input type="number" name="siswa_id" required></div>
                <div class="form-group"><label>ID Mapel:</label><input type="number" name="mapel_id" required></div>
                <div class="form-group"><label>Nilai KKM:</label><input type="number" name="nilai_kkm" required></div>
                <div class="form-group"><label>Nilai Pengetahuan:</label><input type="number" name="nilai_pengetahuan" required></div>
                <div class="form-group"><label>Nilai Keterampilan:</label><input type="number" name="nilai_keterampilan" required></div>
                <div class="form-group"><label>Keterangan:</label><input type="text" name="keterangan" required></div>
                <button type="submit" name="add_nilai">Simpan Nilai</button>
            </form>
            <div>
                <h3>Data Tabel: nilai_rapor</h3>
                <table>
                    <tr><th>ID</th><th>ID Siswa</th><th>ID Mapel</th><th>KKM</th><th>P</th><th>K</th><th>Ket</th></tr>
                    <?php 
                    $q = $koneksi->query("SELECT * FROM nilai_rapor"); 
                    while($r = $q->fetch_assoc()) { 
                        echo "<tr><td>{$r['id']}</td><td>{$r['siswa_id']}</td><td>{$r['mapel_id']}</td><td>{$r['nilai_kkm']}</td><td>{$r['nilai_pengetahuan']}</td><td>{$r['nilai_keterampilan']}</td><td>{$r['keterangan']}</td></tr>"; 
                    } 
                    ?>
                </table>
            </div>
        </div>
    </div>

    <!-- SCRIPT JAVASCRIPT BUAT GANTI TAB -->
    <script>
        function openTab(evt, tabName) {
            // Ambil semua elemen dengan class tab-content dan sembunyikan (hapus class active)
            const tabContents = document.querySelectorAll(".tab-content");
            tabContents.forEach(tab => {
                tab.classList.remove("active");
            });

            // Ambil semua tombol tab dan hapus status active-nya
            const tabBtns = document.querySelectorAll(".tab-btn");
            tabBtns.forEach(btn => {
                btn.classList.remove("active");
            });

            // Tampilkan tab yang diklik dan tambahkan class active buat mancing animasinya
            document.getElementById(tabName).classList.add("active");
            evt.currentTarget.classList.add("active");
        }
    </script>
</body>
</html>