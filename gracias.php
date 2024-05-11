<?php
  session_start();

  if(!isset($_SESSION['ID'])) {
    header('Location: ./login.php');
    exit();
  }

  $page = "contacto";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GRACIAS</title>
  <link href="./styles/styles.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container my-5 text-center">
    <h1 class="h3">GRACIAS POR CONTACTARNOS, PRONTO NOS PONDREMOS EN CONTACTO CONTIGO</h1>
    <a href="./home.php" class="btn btn-dark btn-lg mt-5">Ir a Inicio</a>
  </div>
</body>
</html>