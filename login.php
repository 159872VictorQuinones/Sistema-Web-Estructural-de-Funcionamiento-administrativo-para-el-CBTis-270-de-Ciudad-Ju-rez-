<?php 

  if(!isset($_SESSION)){
    session_start();
  }

  if($_SESSION) {
    // redirigir a pagina de home
    header("Location: ./home.php");
    exit();
  }

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="./styles/styles.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container">
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="bg-white p-4 rounded-3 shadow" style="width: 30rem">
      <img src="./assets/img/logo.jpg" class="img-fluid d-block mx-auto" width="200">
      <h1 class="text-center mb-8 fw-bold title-login">CBTis 270<br>Administrativos</h1>
      <form action="./login-logic.php" method="post">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email</label>
          <input type="email" name="email" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">      
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <div class="d-flex">
            <input type="password" name="password" required class="form-control" id="password">
            <div class="input-group-append">
              <a href="#" class="input-group-text text-decoration-none" id="passwordShowHide" onclick="hideShowPassword()">Mostrar</a>
            </div>
          </div>  
        </div>
        <div class="d-flex justify-content-center align-items-center">
          <button type="submit" class="btn btn-dark btn-lg">Iniciar sesión</button>
        </div>
      </form>

      <?php
        // Mostrar mensaje de errores si existen
        if (isset($errores['password'])) {
            echo "<div class='alert-danger p-2 mt-3'>{$errores['password']}</div>";
        }
      ?>
      </div>

    </div>
  </div>

  <script>
    function hideShowPassword() {
      var password = document.getElementById("password");
      var textPass = document.getElementById("passwordShowHide");
      if (password.type === "password") {
        textPass.innerHTML = "Ocultar";
        password.type = "text";
      } else {
        textPass.innerHTML = "Mostrar";
        password.type = "password";
      }
    }
   
  </script>
</body>
</html>