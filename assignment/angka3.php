<?php
//cara 2
$angka =[ 
        [11, 12, 13, 14, 15, 16, 17, 18],
        [21, 22, 23, 24, 25],
        [31, 32, 33, 34, 35],
    ];

$i = 0;
while ($i < count($angka)) {
    $j = 0;
    while ($j < count($angka[$i])) { 
        echo "Angka: " . $angka[$i][$j] . "<br><br>";
    $j++;
}
$i++;
}
