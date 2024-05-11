<?php

  session_start();

  if(!isset($_SESSION['ID'])) {
    header("Location: /cbtis-sistema/login.php");
  }

  // incluimos la base de datos
  include('./db.php');
  $conn = mysqli_connect($host, $user, $pass, $db);

  $page = "contacto";
  $results = mysqli_query($conn, "SELECT * FROM usuarios");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contacto - CBETIS</title>
  <link href="./styles/styles.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
  <?php include('./components/header/index.php'); ?>
  
  <div class="container">
    <h1 class="text-center my-4">Envía un mensaje</h1>
    <div class="row mt-5 gap-4 justify-content-center">
      <div class="col-8">
        <form action="./sendemail/send-mail.php" method="post" class="bg-white p-4 rounded-3">
          <div>
            <label>Enviar Correo Electrónico a:</label>
            <select class="form-control" name="email">
              <option value="">Seleccionar correo de usuario</option>
              <?php
                if ($results) {
                  // Iterar sobre los resultados
                  while ($row = mysqli_fetch_assoc($results)) {
                      // Acceder al valor de la columna 'email' en cada fila
                      $email = $row['email'];
                      // Puedes imprimir el correo electrónico o hacer cualquier otra cosa con él
                      echo "<option value='" . $email . "'>" . $email . "</option>";
                    }
              } else {
                  // Manejar el caso de que la consulta falle
                  echo "Error en la consulta: " . mysqli_error($conn);
              }
              ?>
            </select>
          </div>

          <div class="mt-4">
            <label>Mensaje</label>
            <textarea class="form-control" name="message" rows="5" placeholder="Escribe tu mensaje..."></textarea>
          </div>
          <button type="submit" class="btn btn-primary mt-4">Agregar</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>