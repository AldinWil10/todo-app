<?php
$anggota = [
    ['nama' => 'toni', 'gol_darah' => 'A'],
    ['nama' => 'dina', 'gol_darah' => 'B'],
    ['nama' => 'angga', 'gol_darah' => 'AB']
];

$data = serialize($anggota);
file_put_contents('latihan.txt', $data);
$print = file_get_contents('latihan.txt');
echo $print;
echo "<br>";
$balik = unserialize($print);
print_r($balik);
