<?php
// sambungan ke pangkalan data
$sambungan = mysqli_connect("localhost", "root", "", "multi_penderia");

// baca data terakhir dari jadual/table tb_deria1 
$ambildata = mysqli_query($sambungan, "SELECT * FROM tb_deria1 ORDER BY id DESC");

// ambil satu baris data dan simpan data ke pembolehubah/variable $suhu
$data = mysqli_fetch_array($ambildata);
$suhu = $data['suhu'];
$periksa_suhu = $data['suhu'];
$kelembapan = $data['kelembapan'];

// jika nilai suhu dalam jadual/table tb_deria1 tiada, buatkan suhu awal = 0
if ($suhu == "")
    $suhu = 0;

// paparkan nilai suhu
echo $suhu;
