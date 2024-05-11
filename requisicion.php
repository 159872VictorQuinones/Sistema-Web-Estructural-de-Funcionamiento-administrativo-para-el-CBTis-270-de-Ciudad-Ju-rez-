<?php
  session_start();

  // Si usuario no está logeado redirigir a login
  if(!isset($_SESSION)){
    header("Location: ./login.php");
  }
  
  $page = "requisicion";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Requisición</title>
  <link href="./styles/styles.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
  <?php include('./components/header/index.php') ?>

  <div class="container mt-5">
    <h1 class="text-center mb-3">Requisición de Materiales</h1>
    <div class="d-flex row justify-content-center align-items-center">
      <div class="col-md-6">
        <a href="./requisicion-crear.php" class="text-decoration-none d-flex w-100 justify-content-center align-items-center btn-requisicion">
          <div class="d-flex flex-column justify-content-center align-items-center">
            <img src="./assets/img/crearnueva.jpg" class="img-fluid" width="500" height="500">
            <h2 class="p-4">Crear Nueva</h2>
          </div>
        </a>
      </div>

      <div class="col-md-6">
        <a href="./requisicion-consultar-activos.php" class="text-decoration-none d-flex w-100 justify-content-center align-items-center btn-requisicion">
          <div class="d-flex flex-column justify-content-center align-items-center" >
            <img src="./assets/img/lookingfor.jpg" class="img-fluid" width="500" height="500">
            <h2 class="p-4">Consultar Activos</h2>
          </div>
        </a>
      </div>
    </div>
  </div>

</body>
</html>