<?php
// sambungan ke pangkalan data
$sambungan = mysqli_connect("localhost", "root", "", "multi_penderia");

// ambil data yang dihantar dari ESP32
$suhu = $_GET['suhu'];
$kelembapan = $_GET['kelembapan'];
$ldr = $_GET['ldr'];

// auto increment menjadi 1 semula, jika id dalam tb_deria1 dikosongkan/tiada data
mysqli_query($sambungan, "ALTER TABLE tb_deria1 AUTO_INCREMENT = 1");

// simpan data dari ESP32 ke jadual/table tb_deria1
$simpan = mysqli_query($sambungan, "INSERT INTO tb_deria1(suhu, kelembapan, ldr) VALUES ('$suhu', '$kelembapan', '$ldr')");

// jika berjaya simpan data
if ($simpan)
    echo "Data berjaya disimpan.";
else
    echo "Data tidak berjaya disimpan.";
