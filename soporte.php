<?php 
  session_start();
  include('./db.php');


  $page = "soporte";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Soporte</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link href="./styles/styles.css" rel="stylesheet">
</head>
<body>
  <?php include('./components/header/index.php'); ?>
  <div class="container my-5">
    <div class="row gap-4">
      <div class="col bg-white p-4">
        <img src="./assets/img/informatica.jpg" class="img-fluid rounded-3">
        <h2 class="mt-3">Soporte Técnico Informático</h2>
        <p class="mt-2">Comúnicate con soporte técnico de informática para resolver algún problema de sistemas.</p>
        <a href="./soporte-informatico.php" class="btn btn-primary mt-4">Reportar problema</a>
      </div>

      <div class="col bg-white p-4">
        <img src="./assets/img/mantenimiento.jpg" class="img-fluid rounded-3">
        <h2 class="mt-3">Soporte Técnico de Mantenimiento</h2>
        <p class="mt-2">Comúnicate con soporte técnico de mantenimiento para resolver algún problema de mantenimiento.</p>
        <a href="./soporte-mantenimiento.php" class="btn btn-primary mt-4">Reportar problema</a>
      </div> 
    </div>
  </div>
</body>
</html>