<?php

// sambungan ke pangkalan data
$sambungan = mysqli_connect("localhost", "root", "", "multi_penderia");

// baca data terakhir dari jadual/table tb_deria1 
$ambildata = mysqli_query($sambungan, "SELECT * FROM tb_deria1 ORDER BY id DESC");

// ambil satu baris data dan simpan data ke pembolehubah/variable $suhu
$data = mysqli_fetch_array($ambildata);
$periksa_suhu = $data['suhu'];
$kelembapan = $data['kelembapan'];

//suhu di antara 19°C hingga 24°C dengan kelembapan pada tahap 60% hingga 70% (kementerian kesihatan malaysia)
// if ($periksa_suhu >= 24 || $kelembapan >= 70) {
//     echo "Dalam bahaya";
// } else {
//     echo "Baik";
// }
