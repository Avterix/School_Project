<?php
//cara 1
$angka = [
    0 => 10,
    1 => 11,
    2 => 12,
];

//cara 2
//$angka = [10, 11, 12];

$i = 0;
while ($i < count($angka)) {
    echo "Angka: " . $angka[$i] . "<br>";
    $i++;
}