<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'koneksi.php';

$alert_message = "";
$alert_type = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_user'])) {
        $id = $koneksi->real_escape_string($_POST['id']);
        $user = $koneksi->real_escape_string($_POST['username']);
        $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = $koneksi->real_escape_string($_POST['role']);
        
        $sql = "INSERT INTO users (id, username, password, role, created_at) VALUES ('$id', '$user', '$pass', '$role', NOW())";
        if ($koneksi->query($sql)) {
            $alert_message = "User successfully created.";
            $alert_type = "success";
        } else {
            $alert_message = "Error creating user: " . $koneksi->error;
            $alert_type = "error";
        }
    }
    elseif (isset($_POST['add_guru'])) {
        $id = $koneksi->real_escape_string($_POST['id']);
        $nip = $koneksi->real_escape_string($_POST['nip']);
        $nama = $koneksi->real_escape_string($_POST['nama']);
        $jk = $koneksi->real_escape_string($_POST['jenis_kelamin']);
        $uid = empty($_POST['user_id']) ? "NULL" : "'" . $koneksi->real_escape_string($_POST['user_id']) . "'";
        
        $sql = "INSERT INTO guru (id, nip, nama, jenis_kelamin, user_id) VALUES ('$id', '$nip', '$nama', '$jk', $uid)";
        if ($koneksi->query($sql)) {
            $alert_message = "Guru record successfully added.";
            $alert_type = "success";
        } else {
            $alert_message = "Error adding guru: " . $koneksi->error;
            $alert_type = "error";
        }
    }
    elseif (isset($_POST['add_siswa'])) {
        $id = $koneksi->real_escape_string($_POST['id']);
        $nis = $koneksi->real_escape_string($_POST['nis']);
        $nama = $koneksi->real_escape_string($_POST['nama']);
        $kelas = $koneksi->real_escape_string($_POST['kelas']);
        $jk = $koneksi->real_escape_string($_POST['jenis_kelamin']);
        $uid = empty($_POST['user_id']) ? "NULL" : "'" . $koneksi->real_escape_string($_POST['user_id']) . "'";
        
        $sql = "INSERT INTO siswa (id, nis, nama, kelas, jenis_kelamin, user_id) VALUES ('$id', '$nis', '$nama', '$kelas', '$jk', $uid)";
        
        // Wrap the query in a try-catch block to prevent fatal crashes
        try {
            if ($koneksi->query($sql)) {
                $alert_message = "Siswa record successfully added.";
                $alert_type = "success";
            }
        } catch (mysqli_sql_exception $e) {
            // Check if the error is specifically a duplicate entry (Error Code 1062)
            if ($e->getCode() == 1062) {
                $alert_message = "Error: ID '$id' already exists. Please use a unique Record ID.";
            } else {
                $alert_message = "Error adding siswa: " . $e->getMessage();
            }
            $alert_type = "error";
        }
    }
    elseif (isset($_POST['add_mapel'])) {
        $id = $koneksi->real_escape_string($_POST['id']);
        $kode = $koneksi->real_escape_string($_POST['kode_mapel']);
        $nama = $koneksi->real_escape_string($_POST['nama_mapel']);
        $gid = empty($_POST['guru_id']) ? "NULL" : "'" . $koneksi->real_escape_string($_POST['guru_id']) . "'";
        
        $sql = "INSERT INTO mapel (id, kode_mapel, nama_mapel, guru_id) VALUES ('$id', '$kode', '$nama', $gid)";
        if ($koneksi->query($sql)) {
            $alert_message = "Mata Pelajaran successfully mapped.";
            $alert_type = "success";
        } else {
            $alert_message = "Error mapping subject: " . $koneksi->error;
            $alert_type = "error";
        }
    }
    elseif (isset($_POST['add_nilai'])) {
        $id = $koneksi->real_escape_string($_POST['id']);
        $sid = $koneksi->real_escape_string($_POST['siswa_id']);
        $mid = $koneksi->real_escape_string($_POST['mapel_id']);
        $kkm = $koneksi->real_escape_string($_POST['nilai_kkm']);
        $p_nget = $koneksi->real_escape_string($_POST['nilai_pengetahuan']);
        $p_ter = $koneksi->real_escape_string($_POST['nilai_keterampilan']);
        $ket = $koneksi->real_escape_string($_POST['keterangan']);
        
        $sql = "INSERT INTO nilai_rapor (id, siswa_id, mapel_id, nilai_kkm, nilai_pengetahuan, nilai_keterampilan, keterangan) VALUES ('$id', '$sid', '$mid', '$kkm', '$p_nget', '$p_ter', '$ket')";
        if ($koneksi->query($sql)) {
            $alert_message = "Nilai Rapor successfully submitted.";
            $alert_type = "success";
        } else {
            $alert_message = "Error submitting nilai: " . $koneksi->error;
            $alert_type = "error";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIACAD System Control</title>
    <style>
        /* CSS Reset & Variables */
        :root {
            --color-bg: #ffffff;
            --color-text: #000000;
            --color-border: #000000;
            --color-hover-bg: #f0f0f0;
            --color-muted: #666666;
            --font-main: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            --spacing-xs: 0.25rem;
            --spacing-sm: 0.5rem;
            --spacing-md: 1rem;
            --spacing-lg: 2rem;
            --spacing-xl: 4rem;
            --border-width: 1px;
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--font-main);
            background-color: var(--color-bg);
            color: var(--color-text);
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            display: flex;
            min-height: 100vh;
	}
	    body::-webkit-scrollbar {
	    display: none;
        }

        /* Typography */
        h1, h2, h3, h4, h5, h6 {
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: -0.02em;
            margin-bottom: var(--spacing-md);
        }

        h1 { font-size: 2.5rem; }
        h2 { font-size: 1.5rem; }
        h3 { font-size: 1.125rem; }
        
        p { margin-bottom: var(--spacing-md); }

        /* Layout Structure */
        .sidebar {
            width: 250px;
            border-right: var(--border-width) solid var(--color-border);
            padding: var(--spacing-lg) var(--spacing-md);
            display: flex;
            flex-direction: column;
            background: var(--color-bg);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: var(--spacing-xl);
            max-width: 1400px;
        }

        .brand {
            font-size: 1.25rem;
            font-weight: 700;
            text-transform: uppercase;
            border-bottom: var(--border-width) solid var(--color-border);
            padding-bottom: var(--spacing-md);
            margin-bottom: var(--spacing-lg);
            letter-spacing: 0.05em;
        }

        /* Navigation Tabs */
        .nav-menu {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: var(--spacing-sm);
        }

        .nav-btn {
            width: 100%;
            text-align: left;
            padding: var(--spacing-sm) var(--spacing-md);
            background: transparent;
            border: var(--border-width) solid transparent;
            color: var(--color-muted);
            font-family: inherit;
            font-size: 0.875rem;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.05em;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .nav-btn:hover {
            color: var(--color-text);
            background: var(--color-hover-bg);
        }

        .nav-btn.active {
            color: var(--color-bg);
            background: var(--color-text);
            border-color: var(--color-text);
        }

        /* Forms & Inputs */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-md);
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-xs);
        }

        label {
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.05em;
        }

        input, select, textarea {
            width: 100%;
            padding: 0.75rem;
            font-family: inherit;
            font-size: 0.875rem;
            background: transparent;
            border: var(--border-width) solid var(--color-border);
            color: var(--color-text);
            border-radius: 0;
            outline: none;
            transition: border-color 0.2s;
        }

        input:focus, select:focus, textarea:focus {
            border-width: 2px;
            padding: calc(0.75rem - 1px);
        }

        button[type="submit"], .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background: var(--color-text);
            color: var(--color-bg);
            border: var(--border-width) solid var(--color-text);
            font-family: inherit;
            font-size: 0.875rem;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.05em;
            cursor: pointer;
            border-radius: 0;
            transition: all 0.2s ease;
        }

        button[type="submit"]:hover, .btn:hover {
            background: var(--color-bg);
            color: var(--color-text);
        }

        /* Tables */
        .table-container {
            width: 100%;
            overflow-x: auto;
            border: var(--border-width) solid var(--color-border);
            margin-top: var(--spacing-lg);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.875rem;
        }

        th, td {
            padding: 1rem;
            border-bottom: var(--border-width) solid var(--color-border);
        }

        th {
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-size: 0.75rem;
            background: #fafafa;
            border-right: var(--border-width) solid var(--color-border);
        }
        
        th:last-child {
            border-right: none;
        }

        td {
            border-right: var(--border-width) solid var(--color-border);
        }

        td:last-child {
            border-right: none;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: var(--color-hover-bg);
        }

        /* Layout utilities */
        .panel {
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .panel.active {
            display: block;
        }

        .section-header {
            border-bottom: var(--border-width) solid var(--color-border);
            padding-bottom: var(--spacing-md);
            margin-bottom: var(--spacing-lg);
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .data-card {
            border: var(--border-width) solid var(--color-border);
            padding: var(--spacing-lg);
            margin-bottom: var(--spacing-xl);
            background: #fff;
        }

        /* Alerts */
        .alert {
            padding: 1rem;
            margin-bottom: var(--spacing-lg);
            border: var(--border-width) solid var(--color-border);
            font-size: 0.875rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .alert.success {
            background: var(--color-text);
            color: var(--color-bg);
        }

        .alert.error {
            background: var(--color-bg);
            color: var(--color-text);
            border-width: 2px;
        }

        .close-alert {
            cursor: pointer;
            font-weight: bold;
            padding: 0 0.5rem;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            body { flex-direction: column; }
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                border-right: none;
                border-bottom: var(--border-width) solid var(--color-border);
                padding: var(--spacing-md);
            }
            .main-content {
                margin-left: 0;
                padding: var(--spacing-md);
            }
            .nav-menu { flex-direction: row; flex-wrap: wrap; }
            .nav-btn { width: auto; flex: 1; text-align: center; }
        }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="brand">Database Control</div>
        <nav>
            <ul class="nav-menu">
                <li><button class="nav-btn active" data-target="panel-users">Users</button></li>
                <li><button class="nav-btn" data-target="panel-guru">Guru</button></li>
                <li><button class="nav-btn" data-target="panel-siswa">Siswa</button></li>
                <li><button class="nav-btn" data-target="panel-mapel">Mapel</button></li>
                <li><button class="nav-btn" data-target="panel-nilai">Nilai Rapor</button></li>
            </ul>
        </nav>
    </aside>

    <main class="main-content">
        
        <?php if (!empty($alert_message)): ?>
        <div class="alert <?php echo $alert_type; ?>" id="system-alert">
            <span><?php echo $alert_message; ?></span>
            <span class="close-alert" onclick="document.getElementById('system-alert').style.display='none'">&#10005;</span>
        </div>
        <?php endif; ?>

        <!-- PANEL: USERS -->
        <section id="panel-users" class="panel active">
            <div class="section-header">
                <h2>User Management</h2>
            </div>
            
            <div class="data-card">
                <h3>Register New User</h3>
                <form action="" method="POST">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="user_id">User ID</label>
                            <input type="text" id="user_id" name="id" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select id="role" name="role" required>
                                <option value="">Select Role</option>
                                <option value="admin">Admin</option>
                                <option value="guru">Guru</option>
                                <option value="siswa">Siswa</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" name="add_user">Append User Data</button>
                </form>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Created Timestamp</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $q = $koneksi->query("SELECT * FROM users ORDER BY created_at DESC"); 
                        if($q && $q->num_rows > 0) {
                            while($r = $q->fetch_assoc()) { 
                                echo "<tr>
                                        <td>{$r['id']}</td>
                                        <td>{$r['username']}</td>
                                        <td>{$r['role']}</td>
                                        <td>{$r['created_at']}</td>
                                      </tr>"; 
                            }
                        } else {
                            echo "<tr><td colspan='4' style='text-align:center; padding: 2rem;'>No records found in database.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- PANEL: GURU -->
        <section id="panel-guru" class="panel">
            <div class="section-header">
                <h2>Guru Registry</h2>
            </div>

            <div class="data-card">
                <h3>Add Instructor Record</h3>
                <form action="" method="POST">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="guru_id">Record ID</label>
                            <input type="text" id="guru_id" name="id" required>
                        </div>
                        <div class="form-group">
                            <label for="nip">NIP (Nomor Induk)</label>
                            <input type="text" id="nip" name="nip" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_guru">Full Name</label>
                            <input type="text" id="nama_guru" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="jk_guru">Gender</label>
                            <select id="jk_guru" name="jenis_kelamin" required>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="uid_guru">System Account ID (Optional)</label>
                            <input type="text" id="uid_guru" name="user_id" placeholder="Leave blank if none">
                        </div>
                    </div>
                    <button type="submit" name="add_guru">Commit Record</button>
                </form>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NIP</th>
                            <th>Full Name</th>
                            <th>Gender</th>
                            <th>Linked Account</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $q = $koneksi->query("SELECT g.*, u.username FROM guru g LEFT JOIN users u ON g.user_id = u.id ORDER BY g.nama ASC"); 
                        if($q && $q->num_rows > 0) {
                            while($r = $q->fetch_assoc()) { 
                                $acc = $r['username'] ? $r['username'] : '-';
                                echo "<tr>
                                        <td>{$r['id']}</td>
                                        <td>{$r['nip']}</td>
                                        <td>{$r['nama']}</td>
                                        <td>{$r['jenis_kelamin']}</td>
                                        <td>{$acc}</td>
                                      </tr>"; 
                            }
                        } else {
                            echo "<tr><td colspan='5' style='text-align:center; padding: 2rem;'>No instructor records found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- PANEL: SISWA -->
        <section id="panel-siswa" class="panel">
            <div class="section-header">
                <h2>Siswa Registry</h2>
            </div>

            <div class="data-card">
                <h3>Add Student Record</h3>
                <form action="" method="POST">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="siswa_id">Record ID</label>
                            <input type="text" id="siswa_id" name="id" required>
                        </div>
                        <div class="form-group">
                            <label for="nis">NIS</label>
                            <input type="text" id="nis" name="nis" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_siswa">Full Name</label>
                            <input type="text" id="nama_siswa" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="kelas">Class/Grade</label>
                            <input type="text" id="kelas" name="kelas" required>
                        </div>
                        <div class="form-group">
                            <label for="jk_siswa">Gender</label>
                            <select id="jk_siswa" name="jenis_kelamin" required>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="uid_siswa">System Account ID (Optional)</label>
                            <input type="text" id="uid_siswa" name="user_id">
                        </div>
                    </div>
                    <button type="submit" name="add_siswa">Commit Record</button>
                </form>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NIS</th>
                            <th>Name</th>
                            <th>Class</th>
                            <th>Gender</th>
                            <th>Linked Account</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $q = $koneksi->query("SELECT s.*, u.username FROM siswa s LEFT JOIN users u ON s.user_id = u.id ORDER BY s.kelas, s.nama"); 
                        if($q && $q->num_rows > 0) {
                            while($r = $q->fetch_assoc()) { 
                                $acc = $r['username'] ? $r['username'] : '-';
                                echo "<tr>
                                        <td>{$r['id']}</td>
                                        <td>{$r['nis']}</td>
                                        <td>{$r['nama']}</td>
                                        <td>{$r['kelas']}</td>
                                        <td>{$r['jenis_kelamin']}</td>
                                        <td>{$acc}</td>
                                      </tr>"; 
                            }
                        } else {
                            echo "<tr><td colspan='6' style='text-align:center; padding: 2rem;'>No student records found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- PANEL: MAPEL -->
        <section id="panel-mapel" class="panel">
            <div class="section-header">
                <h2>Curriculum & Mapel</h2>
            </div>

            <div class="data-card">
                <h3>Map Subject to Instructor</h3>
                <form action="" method="POST">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="mapel_id">Record ID</label>
                            <input type="text" id="mapel_id" name="id" required>
                        </div>
                        <div class="form-group">
                            <label for="kode_mapel">Subject Code</label>
                            <input type="text" id="kode_mapel" name="kode_mapel" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_mapel">Subject Name</label>
                            <input type="text" id="nama_mapel" name="nama_mapel" required>
                        </div>
                        <div class="form-group">
                            <label for="mapel_guru_id">Instructor ID (Guru)</label>
                            <input type="text" id="mapel_guru_id" name="guru_id">
                        </div>
                    </div>
                    <button type="submit" name="add_mapel">Establish Curriculum</button>
                </form>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Code</th>
                            <th>Subject Designation</th>
                            <th>Assigned Instructor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $q = $koneksi->query("SELECT m.*, g.nama FROM mapel m LEFT JOIN guru g ON m.guru_id = g.id ORDER BY m.kode_mapel ASC"); 
                        if($q && $q->num_rows > 0) {
                            while($r = $q->fetch_assoc()) { 
                                $inst = $r['nama'] ? $r['nama'] : 'Unassigned';
                                echo "<tr>
                                        <td>{$r['id']}</td>
                                        <td>{$r['kode_mapel']}</td>
                                        <td>{$r['nama_mapel']}</td>
                                        <td>{$inst}</td>
                                      </tr>"; 
                            }
                        } else {
                            echo "<tr><td colspan='4' style='text-align:center; padding: 2rem;'>No curriculum records found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- PANEL: NILAI RAPOR -->
        <section id="panel-nilai" class="panel">
            <div class="section-header">
                <h2>Academic Evaluation</h2>
            </div>

            <div class="data-card">
                <h3>Input Rapor Metrics</h3>
                <form action="" method="POST">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="nilai_id">Record ID</label>
                            <input type="text" id="nilai_id" name="id" required>
                        </div>
                        <div class="form-group">
                            <label for="n_siswa_id">Student ID</label>
                            <input type="text" id="n_siswa_id" name="siswa_id" required>
                        </div>
                        <div class="form-group">
                            <label for="n_mapel_id">Subject ID</label>
                            <input type="text" id="n_mapel_id" name="mapel_id" required>
                        </div>
                        <div class="form-group">
                            <label for="kkm">KKM Threshold</label>
                            <input type="number" id="kkm" name="nilai_kkm" min="0" max="100" required>
                        </div>
                        <div class="form-group">
                            <label for="p_nget">Cognitive Score</label>
                            <input type="number" id="p_nget" name="nilai_pengetahuan" min="0" max="100" required>
                        </div>
                        <div class="form-group">
                            <label for="p_ter">Psychomotor Score</label>
                            <input type="number" id="p_ter" name="nilai_keterampilan" min="0" max="100" required>
                        </div>
                        <div class="form-group">
                            <label for="ket">Remarks</label>
                            <select id="ket" name="keterangan" required>
                                <option value="Tuntas">Tuntas</option>
                                <option value="Belum Tuntas">Belum Tuntas</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" name="add_nilai">Submit Evaluation</button>
                </form>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Eval ID</th>
                            <th>Student Ref</th>
                            <th>Subject Ref</th>
                            <th>KKM</th>
                            <th>Cognitive</th>
                            <th>Motor</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $q = $koneksi->query("SELECT * FROM nilai_rapor ORDER BY id DESC"); 
                        if($q && $q->num_rows > 0) {
                            while($r = $q->fetch_assoc()) { 
                                echo "<tr>
                                        <td>{$r['id']}</td>
                                        <td>{$r['siswa_id']}</td>
                                        <td>{$r['mapel_id']}</td>
                                        <td>{$r['nilai_kkm']}</td>
                                        <td>{$r['nilai_pengetahuan']}</td>
                                        <td>{$r['nilai_keterampilan']}</td>
                                        <td>{$r['keterangan']}</td>
                                      </tr>"; 
                            }
                        } else {
                            echo "<tr><td colspan='7' style='text-align:center; padding: 2rem;'>No evaluation records found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const navButtons = document.querySelectorAll('.nav-btn');
            const panels = document.querySelectorAll('.panel');

            navButtons.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const targetId = e.target.getAttribute('data-target');
                    
                    navButtons.forEach(b => b.classList.remove('active'));
                    e.target.classList.add('active');

                    panels.forEach(p => {
                        p.classList.remove('active');
                        if (p.id === targetId) {
                            p.classList.add('active');
                        }
                    });
                });
            });

            // Auto-hide alert after 5 seconds
            const alertBox = document.getElementById('system-alert');
            if(alertBox) {
                setTimeout(() => {
                    alertBox.style.opacity = '0';
                    alertBox.style.transition = 'opacity 0.5s ease';
                    setTimeout(() => alertBox.style.display = 'none', 500);
                }, 5000);
            }
        });
    </script>
</body>
</html>