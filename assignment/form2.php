<?php

require 'navbar.php';
?>
<head>
    <link rel="stylesheet" href="style1.css">
</head>
<div class="form2" style="margin: 0 auto; width: 25%;">

    <div class="container text-center" style="margin: 0 auto;">
    <div class="form" >
     <div class="card" style="margin-top: 20px;">
        <div class="card-form">
         <h2>Form Tambah Siswa</h2><br>
</div>
  <div class="card-body">
    <h1>Data Profil Siswa</h1>
  </div>
  <div class="mb-3">
  <input type="number"  class="form-control" id="exampleFormControlInput1" placeholder="Nomor Induk Siswa | Contoh:12345678" style="width: 90%; margin: 0 auto;" />
</div>
<br>
<div class="mb-3">
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nama Lengkap Siswa | Contoh:Ujang" style="width: 90%; margin: 0 auto;" />
</div>
<br>
 <div class="mb-3">
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Kelas Siswa | Contoh:X-RPL-1" style="width: 90%; margin: 0 auto;" />
</div>
<br>
<div class="radio">
    Jenis Kelamin:
    <br>
  <input type="radio" name="gender" value="Laki-laki" />
  <label for="Laki-laki">Laki-laki</label>
  <br>
  <input type="radio" name="gender" value="Perempuan" id="Perempuan" />
  <label for="Perempuan">Perempuan</label>
</div>
  </div>
</div>
</div>