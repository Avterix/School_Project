<?php

require 'navbar.php';
?>
<head>
    <link rel="stylesheet" href="style1.css">
</head>
<div class="form2" style="margin: 0 auto; width: 30%;">

    <div class="container text-center" style="margin: 0 auto;">
    <div class="form" >
     <div class="card" style="margin-top: 20px;">
        <div class="card-form">
         <h2>Form Tambah Siswa</h2><br>
</div>
  <div class="card-body">
   <form action="" method="POST">
    <h1>Data Profil Siswa</h1>
  </div>
  <div class="mb-3">
  <input type="number" name="nis" class="form-control" id="exampleFormControlInput1" placeholder="Nomor Induk Siswa | Contoh:12345678" style="width: 90%; margin: 0 auto;" />
</div>
<br>
<div class="mb-3">
  <input type="text" name="nama" class="form-control" id="exampleFormControlInput1" placeholder="Nama Lengkap Siswa | Contoh:Ujang Asep" style="width: 90%; margin: 0 auto;" />
</div>
<br>
 <div class="mb-3">
  <input type="text" name="kelas" class="form-control" id="exampleFormControlInput1" placeholder="Kelas Siswa | Contoh:X-RPL-1" style="width: 90%; margin: 0 auto;" />
</div>
<br>
<div class="radio">
    Jenis Kelamin:
    <br>
  <input type="radio" name="jenis_kelamin" value="Laki-laki" />
  <label for="Laki-laki">Laki-laki</label>
  <br>
  <input type="radio" name="jenis_kelamin" value="Perempuan" id="Perempuan" />
  <label for="Perempuan">Perempuan</label>
</div>
<br>
<div class="form2" style="border: 1px solid #d3d3d3;">
    <h3>Data Kredensial Akun (Tabel <br> Users)</h3><br>
<div class="mb-3">
  <input type="text" name="username" class="form-control" id="exampleFormControlInput1" placeholder="Username Akun | Contoh:ujang123" style="width: 90%; margin: 0 auto;" />
</div>
<br>
<div class="mb-3">
  <input type="password" name="password" class="form-control" id="exampleFormControlInput1" placeholder="Password Akun | Contoh:password123" style="width: 90%; margin: 0 auto;" />
</div>
<br>
<div class="button1">
<button type="submit" name="kirim" class="btn btn-primary" style="margin-bottom: 20px;">Simpan Data</button>
<button type="submit" class="btn btn-danger" style="margin-bottom: 20px;">Kembali</button>
    </div>
  </div>
</div>
</div>
<br>
<br>

<div class="form2" style="margin: 0 auto; width: 105%;">

    <div class="container text-center" style="margin: 0 auto; margin-left: -10px;">
    <div class="form" >
     <div class="card" style="margin-top: 20px;">
        <div class="card-form">
         <h2>Output dari Form</h2><br>
         <div class="card-get">
<?php
    $nis            =   $_POST['nis'];
    $nama           =   $_POST['nama'];
    $kelas          =   $_POST['kelas'];
    $jenis_kelamin  =   $_POST['jenis_kelamin'];
    $username       =   $_POST['username'];
$password       =   $_POST['password'];

echo "NIS:  " . $nis . "<br>";
echo "Nama:  " . $nama . "<br>";
echo "Kelas:  " . $kelas . "<br>";
echo "Jenis Kelamin:  " . $jenis_kelamin . "<br>";
echo "Username:  " . $username . "<br>";
echo "Password:  " . $password . "<br>";