<?php
$hostname = "localhost";
$username = "root";
$password = "";
$db       = "db_siacad_smk";

$koneksi = mysqli_connect($hostname, $username, $password, $db);

if (!$koneksi) {
    die("Koneksi Database Gagal: " . mysqli_connect_error());
}
?>