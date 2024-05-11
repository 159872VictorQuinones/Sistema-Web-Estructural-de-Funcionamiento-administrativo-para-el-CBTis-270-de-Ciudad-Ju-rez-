<?php
  session_start();

  // Si usuario no está logeado redirigir a login
  if(!isset($_SESSION)){
    header("Location: ./login.php");
  }
  include('./db.php');
  $conn = mysqli_connect($host, $user, $pass, $db);
  
  if (mysqli_connect_errno())
  {
    echo "Fallo la conexion a la base de datos: " . mysqli_connect_error();
  } 

  // Recuperar ID de la sesión
  $user_id = $_SESSION['ID'];

  // Obtener resultados de requisicion por user_id
  $results = mysqli_query($conn, "SELECT * FROM requisicion WHERE user_id = $user_id ORDER BY no_prioridad");
 
  $page = "requisicion";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear nueva requisición</title>

  <link href="./styles/styles.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  
  <script>
    function confirmarEliminacion(id) {
      var confirmacion = window.confirm("¿Estás seguro de que quieres eliminar este registro?");

      if (confirmacion) {
          window.location.href = "./form-requisicion/delete.php?id=" + id;
      }
    }
  </script>
</head>
<body>
  <?php include('./components/header/index.php') ?>

  <div class="container my-5">
    <h1 class="mb-3 text-center">Consulta de Activos de Requisición</h1>

      <div class="table-responsive mt-2">
      <table class="table table-striped">
        <thead class="bg-white">
          <tr>
            <th scope="col">Fecha</th>
            <th scope="col">Departamento</th>
            <th scope="col">Materiales a utilizar</th>
            <th scope="col">No. Prioridad</th>
            <th scope="col">Descripción</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Unidad</th>
            <th scope="col">Importe Estimado</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <!-- Rellenamos datos desde la base de datos -->
          <?php 
            foreach ( $results as $r ) {
              echo '<tr>';
              foreach($r as $v => $value) {   
                if($v != 'ID' AND $v != 'user_id')  {
                  echo '<td style="word-break: break-word;">'.$value.'</td>';
                }            
              }
              
              echo '<td>';
              echo '<a class="btn btn-success" href="./form-requisicion/editpage.php?id=' . $r['ID'] . '"">Editar</a>';
              echo "<a class='btn btn-danger mt-2' href='#' onclick='confirmarEliminacion(" . $r["ID"] . ")'>Eliminar</a>";
              echo '</td>';
              echo '</tr>';
            }
          ?>
        </tbody>
      </table>
    </div>

    </div>
   
  </div>
</body>
</html>