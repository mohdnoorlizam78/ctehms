<?php
// sambungan ke pangkalan data
$sambungan = mysqli_connect("localhost", "root", "", "multi_penderia");

// baca data terakhir dari jadual/table tb_deria1 
$ambildata = mysqli_query($sambungan, "SELECT * FROM tb_deria1 ORDER BY id DESC");

// ambil satu baris data dan simpan data ke pembolehubah/variable $ldr
$data = mysqli_fetch_array($ambildata);
$ldr = $data['ldr'];

// jika nilai ldr dalam jadual/table tb_deria1 tiada, buatkan ldr awal = 0
if ($ldr == "")
    $ldr = 0;

// paparkan nilai ldr
echo $ldr;
