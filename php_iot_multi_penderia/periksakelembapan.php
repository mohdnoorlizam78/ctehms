<?php
//sambungan ke pangkalan data
$sambungan = mysqli_connect("localhost", "root", "", "multi_penderia");

//baca data terakhir dari jadual/table tb_deria1 
$ambildata = mysqli_query($sambungan, "SELECT * FROM tb_deria1 ORDER BY id DESC");

//ambil satu baris data dan simpan data ke pembolehubah/variable $kelembapan
$data = mysqli_fetch_array($ambildata); // ambil satu baris data
$kelembapan = $data['kelembapan'];

//jika nilai kelembapan dalam jadual/table tb_deria1 tiada, buatkan kelembapan awal = 0
if ($kelembapan == "")
    $kelembapan = 0;

// paparkan nilai kelembapan
echo $kelembapan;
