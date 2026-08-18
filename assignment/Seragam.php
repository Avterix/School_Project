<?php

$hari = "senin";

if ($hari == "senin") {
    echo "Hari " . $hari . "<br>";
    echo "Seragam : Putih Abu";
}else if ($hari == "selasa" || $hari == "kamis") {
    echo "Hari " . $hari . "<br>";
    echo "Seragam : Seragam Jurusan";
}else if ($hari == "rabu") {
    echo "Hari " . $hari . "<br>";
    echo "Seragam : Almet";
}else if ($hari == "jumat") {
    echo "Hari " . $hari . "<br>";
    echo "Seragam : Seragam Pramuka";
}
else {
    echo "Hari " . $hari . "<br>";
    echo "Seragam : Bebas";
}    