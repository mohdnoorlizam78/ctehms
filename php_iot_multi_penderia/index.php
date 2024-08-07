<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pemantauan Multi Penderia</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>


<body>
  <div class="container" style="text-align: center; margin-top:50px">
    <h1>Sistem Pemantauan Suhu dan Kelembapan Terpusat <br> Secara Masa Sebenar</h1>
    <div id="realTimeDate" style="font-size: 40px;"></div>

    <script>
      function updateRealTimeDate() {
        // Get the current date
        var currentDate = new Date();

        // Format the date
        var formattedDate = formatDate(currentDate);

        // Update the displayed time
        document.getElementById('realTimeDate').innerText = formattedDate;
      }

      function formatDate(date) {
        // Extract date components
        var day = String(date.getDate()).padStart(2, '0');
        var month = String(date.getMonth() + 1).padStart(2, '0');
        var year = date.getFullYear();

        // Extract time components
        var hours = date.getHours();
        var minutes = String(date.getMinutes()).padStart(2, '0');
        var seconds = String(date.getSeconds()).padStart(2, '0');

        // Convert hours to 12-hour format and determine AM/PM
        var ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12; // Handle midnight (0 hours)

        // Construct the formatted date string
        var formattedDate = day + '-' + month + '-' + year + ' ' + hours + ':' + minutes + ':' + seconds + ' ' + ampm;

        return formattedDate;
      }

      // Update the real-time date initially
      updateRealTimeDate();

      // Update the real-time date every second
      setInterval(updateRealTimeDate, 1000);
    </script>
</body>

</html>


<div style="display: flex;">
  <!-- paparkan nilai suhu -->
  <div class="card text-center" style="width: 30%">
    <div class="card-header" style="font-size: 40px; font-weight:bold; background-color:limegreen; color:white">
      Suhu sekarang
    </div>
    <div class="card-body">
      <h1><span id="periksasuhu"> 0 </span>°C</h1>
    </div>

  </div>
  <!-- akhir paparan suhu -->

  <!-- paparkan nilai kelembapan -->
  <div class="card text-center" style="width: 40%">
    <div class="card-header" style="font-size: 40px; font-weight:bold; background-color:orange; color:white">
      Kelembapan sekarang
    </div>
    <div class="card-body">
      <h1><span id="periksakelembapan"> 0 </span>%</h1>
    </div>

  </div>

  <!-- paparkan status persekitaran -->
  <div class="card text-center" style="width: 30%">
    <div class="card-header" style="font-size: 40px; font-weight:bold; background-color:blue; color:white">
      Status Bilik
    </div>

    <!-- suhu di antara 19°C hingga 24°C dengan kelembapan pada tahap 60% hingga 70% (kementerian kesihatan malaysia)
  -->
    <div class="card-body">
      <h1>
        <span id="periksa_status"><?php include 'blink.php'; ?></span>
      </h1>
    </div>

  </div>
  <!-- akhir paparan status persekitaran -->
</div>

<!-- paparan logo -->
<div class="container" style="padding: top 50px;">
  <img src="images/logo.png" width="30%" height="30%">

</div>
<!-- akhir paparan logo -->

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

<script src="jquery/jquery.min.js"></script>
<!-- data secara masa sebenar -->
<script>
  $(document).ready(function() {
    setInterval(function() {
      $("#periksasuhu").load("periksasuhu.php");
      $("#periksakelembapan").load("periksakelembapan.php");
      $("#periksa_status").load("blink.php");
    }, 1000);
  });
</script>

</body>

</html>