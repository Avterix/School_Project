<?php

$angka =[ 
        [21, 22, 23, 24, 25],
        [31, 32, 33, 34, 35],
        [41, 42, 43, 44, 45],
    ];

echo "Kesatu: " . "<br><br>";
for ($i = 0; $i < count($angka); $i++) {
    for ($j = 0; $j < count($angka[$i]); $j++) {
        echo " ". $angka[$i][$j] . " ";
    }
    echo "<br>";
}

echo "<br><br>";
echo "Kedua: " . "<br><br>";
for ($i = 2; $i < count($angka); $i++) {
    for ($j = 0; $j < count($angka[$i]); $j++) {
        echo "" . $angka[$j][0] . " " . $angka[$j][4] . "<br><br>" ; 
    }
}

echo "Ketiga: " . "<br><br>";
for ($i = 1; $i < count($angka); $i++) {
    for ($j = 0; $j < count($angka[$i]); $j++) {
        if ($i != 1 ) {
            continue;
        }
        echo "" . $angka[$i][$j] . " " ; 
    }
}

echo "<br><br>";
echo "Keempat: " . "<br><br>";
for ($i = 2; $i < count($angka); $i++) {
    for ($j = 0; $j < count($angka[$i]); $j++) {
        echo "" . $angka[$i][$j] . " " ; 
    }
}

echo "<br><br>";
echo "Kelima: " . "<br><br>";
for ($i = 0; $i < count($angka); $i++) {
        echo "" . $angka[$i][$i * 2] . " " . "<br><br>"; 
    }

