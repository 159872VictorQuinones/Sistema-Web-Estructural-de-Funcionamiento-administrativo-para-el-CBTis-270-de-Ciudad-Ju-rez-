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
  
  // Recuperar ID del usuario en sesión
  $user_id = $_SESSION['ID'];
  $tipo_usuario_ID = $_SESSION['tipo_usuario_ID'];

  // Si el profesor esta autenticado entonces redirigir a pagina home

  if($tipo_usuario_ID == 15) {
    header("Location: ./home.php");
  }

  $results = mysqli_query($conn, "SELECT 
                                    usuarios.email,
                                    inventario.*
                                  FROM inventario 
                                  INNER JOIN usuarios 
                                  ON inventario.user_id = usuarios.ID ORDER BY usuarios.email");
 
  $page = "inventario-admin";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventario</title>
  <link href="./styles/styles.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <script>
    function confirmarEliminacion(id) {
      var confirmacion = window.confirm("¿Estás seguro de que quieres eliminar este registro?");

      if (confirmacion) {
          window.location.href = "./form-inventario/delete.php?id=" + id;
      }
    }
  </script>
</head>
<body>
  <?php include('./components/header/index.php') ?>

  <div class="container my-5">
    <h1 class="mb-3">Inventario de todos los usuarios</h1>
    <div>
      <form action="./form-inventario/create.php" method="post" class="d-flex gap-2 mb-2">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <div>
          <input class="form-control bg-dark text-white" required name="no_serie" placeholder="No. Serie" type="text" min="1">
        </div>
        <div>
          <input class="form-control bg-dark text-white" required name="producto" placeholder="Producto" type="text">
        </div>
        <div>
          <input class="form-control bg-dark text-white" name="marca" placeholder="Marca" type="text">
        </div>
        <div>
          <input class="form-control bg-dark text-white" name="modelo" placeholder="Modelo" type="text">
        </div>
        <div>
          <input class="form-control bg-dark text-white" name="descripcion" placeholder="Descripción" type="text">
        </div>
        <div>
          <input class="form-control bg-dark text-white" required name="cantidad" placeholder="Cantidad" type="number" min="1">
        </div>
        <div>
          <input class="form-control bg-dark text-white" required name="unidad" placeholder="Unidad" type="text">
        </div>
        <button class="btn btn-primary">Agregar</button>
      </form>
    </div>
   
    <div class="table-responsive">
      <table class="table table-dark">
        <thead>
          <tr>
            <th scope="col">Usuario</th>
            <th scope="col">No. Serie</th>
            <th scope="col">Producto</th>
            <th scope="col">Marca</th>
            <th scope="col">Modelo</th>
            <th scope="col">Descripción</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Unidad</th>
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
                  echo '<td>'.$value.'</td>';
                }            
              }
              
              echo '<td>';
              echo '<a class="btn btn-success" href="./form-inventario/editpage.php?id=' . $r['ID'] . '"">Editar</a>';
              echo "<a class='btn btn-danger mt-2' href='#' onclick='confirmarEliminacion(" . $r["ID"] . ")'>Eliminar</a>";
              echo '</td>';
              echo '</tr>';
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>

</body>
</html>