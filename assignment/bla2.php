<?php

require 'bla3.php';

//$a = 1;
//while ($a < count($NamaSiswa)) {
//    echo "Nomor : " . ($a++) . "<br>";
  //  echo "Nama : " . $NamaSiswa[$a]['nama'] . "<br>";
//    echo "Umur : " . $NamaSiswa[$a]['umur'] . "<br>";
 //   echo "Alamat : " . $NamaSiswa[$a]['alamat'] . "<br>";
  //  echo "<br>";
  //  $a++;
//}

//$a = 0;
//foreach ($NamaSiswa as $siswa) {
//    echo "Nomor : " . ($a++) . "<br>";
//    echo "Nama : " . $siswa['nama'] . "<br>";
//    echo "Umur : " . $siswa['umur'] . "<br>";
//    echo "Alamat : " . $siswa['alamat'] . "<br>";
//    echo "<br>";

//    $a++;
//}


for ($i = 0; $i < count($NamaSiswa); $i++) {
    if ($NamaSiswa[$i]["umur"] === 17) {
        echo "Nama: " . $NamaSiswa[$i]["nama"] . "<br>";
        echo "Umur: " . $NamaSiswa[$i]["umur"] . "<br>";
        echo "Alamat: " . $NamaSiswa[$i]["alamat"] . "<br><br>";
    }
}