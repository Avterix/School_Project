<?php

$nilai = "59";

switch ($nilai) {
    case ($nilai >= 91 && $nilai <= 100):
        echo "Nilai " . $nilai . "<br>";
        echo "Grade : A";
        break;
    case ($nilai >= 81 && $nilai <= 90):
        echo "Nilai " . $nilai  . "<br>";
        echo "Grade : B";
        break;
    case ($nilai >= 71 && $nilai <= 80):
        echo "Nilai " . $nilai . "<br>";
        echo "Grade : C";
        break;
    case ($nilai >= 61 && $nilai <= 70):
        echo "Nilai " . $nilai  . "<br>";
        echo "Grade : D";
        break;
    default:
        echo "Nilai " . $nilai . "<br>";
        echo "Grade : E";
}    