<?php
header("Content-Type: text/html"); // Ensures the content is treated as HTML
include 'status.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blinking Text</title>
    <style>
        .blink {
            animation: blink-animation 1s steps(3, end) infinite;
        }

        @keyframes blink-animation {
            0% {
                visibility: hidden;
            }

            50% {
                visibility: visible;
            }

            100% {
                visibility: hidden;
            }
        }
    </style>
</head>

<body>
    <?php
    if ($periksa_suhu >= 26 || $kelembapan >= 70) {
        print '<p class="blink" style="background-color:red; color:white">Suhu atau kelembapan tinggi</p>';
    } else {
        print '<p class="card-body" style="color:limegreen">Baik</p>';
    }

    ?>

</body>

</html>