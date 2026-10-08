<?php
// Mengaktifkan laporan error penuh dari MySQL agar kelihatan jika ada kendala kolom database
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); 

require_once 'koneksi.php'; // Hubungkan ke file koneksi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil dan bersihkan data kredensial dasar
    $username      = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password      = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role          = strtolower(trim($_POST['role'])); // Memaksa teks role bersih dan huruf kecil

    // Ambil data profil opsional
    $nama          = isset($_POST['nama']) ? mysqli_real_escape_string($koneksi, $_POST['nama']) : '';
    $jenis_kelamin = isset($_POST['jenis_kelamin']) ? $_POST['jenis_kelamin'] : '';
    $nip           = isset($_POST['nip']) ? mysqli_real_escape_string($koneksi, $_POST['nip']) : '';
    $nis           = isset($_POST['nis']) ? mysqli_real_escape_string($koneksi, $_POST['nis']) : '';
    $kelas         = isset($_POST['kelas']) ? mysqli_real_escape_string($koneksi, $_POST['kelas']) : '';

    try {
        // ========================================================
        // MULAI DATABASE TRANSACTION (Mengunci agar tidak bocor)
        // ========================================================
        mysqli_begin_transaction($koneksi);

        // 1. Amankan data kredensial ke tabel users
        $sql_users = "INSERT INTO users (username, password, role, created_at) VALUES ('$username', '$password', '$role', NOW())";
        mysqli_query($koneksi, $sql_users);
        
        // Ambil ID User yang baru dibuat untuk kebutuhan relasi (Foreign Key)
        $id_terakhir = mysqli_insert_id($koneksi);

        // 2. Cabangkan query otomatis berdasarkan role yang divalidasi
        if ($role === 'siswa') {
            $sql_siswa = "INSERT INTO siswa (nis, nama, kelas, jenis_kelamin, user_id) VALUES ('$nis', '$nama', '$kelas', '$jenis_kelamin', '$id_terakhir')";
            mysqli_query($koneksi, $sql_siswa);

        } elseif ($role === 'guru') {
            $sql_guru = "INSERT INTO guru (nip, nama, jenis_kelamin, user_id) VALUES ('$nip', '$nama', '$jenis_kelamin', '$id_terakhir')";
            mysqli_query($koneksi, $sql_guru);

        } elseif ($role === 'admin') {
            // Admin tidak mengisi tabel profil tambahan apa pun
        }

        // ========================================================
        // JIKA SEMUA QUERY BERHASIL -> SIMPAN PERMANEN (COMMIT)
        // ========================================================
        mysqli_commit($koneksi);

        echo "<script>
                alert('Mantap Bre! Data " . strtoupper($role) . " berhasil disimpan secara utuh!'); 
                window.location.href='daftar_user.php';
              </script>";
        exit;

    } catch (mysqli_sql_exception $e) {
        // ========================================================
        // JIKA ADA SALAH SATU QUERY GAGAL -> BATALKAN TOTAL (ROLLBACK)
        // ========================================================
        mysqli_rollback($koneksi);

        // Menampilkan pesan error spesifik dari MySQL agar mudah dilacak penyebabnya
        echo "<div style='color: red; background: #f8d7da; padding: 20px; border: 1px solid #f5c6cb; font-family: monospace; border-radius: 5px; width: 60%; margin: 30px auto;'>";
        echo "<h2>Aduh Bre, MySQL Transaksi Gagal!</h2>";
