<?php
//cara 2
$angka =[ 
        [21, 22, 23, 24, 25],
        [31, 32, 33, 34, 35],
        [41, 42, 43, 44, 45],
    ];


for ($i = 1; $i < count($angka); $i++) {
    if ($j >= 3 ) {
        continue;
    }
    for ($j = 0; $j < count($angka[$i]); $j++) {
        echo "" . $angka[$i][$j] . "<br><br>" ;
    }
}