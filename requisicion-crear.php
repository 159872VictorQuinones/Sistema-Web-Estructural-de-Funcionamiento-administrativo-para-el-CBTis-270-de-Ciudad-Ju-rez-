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
    <h1 class="mb-3 text-center">Requisición</h1>
    <div>
      <form action="./form-requisicion/create.php" method="post" class="row">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <div class="col-md-6">
          <div>
            <label>Fecha</label>
            <input class="form-control" type="date" name="fecha" required|>
          </div>
        </div>
     
        <div class="col-md-6">
          <div>
            <label>Departamento</label>
            <select class="form-control" name="departamento" required>
              <option value="">Seleccionar departamento</option>
              <option value="Personal Docente">Personal Docente</option>
              <option value="Subdirección academica">Subdirección academica</option>
              <option value="Subdirección administrativa">Subdirección administrativa</option>
              <option value="Dirección">Dirección</option>
              <option value="Control escolar">Control escolar</option>
              <option value="Vinculación">Vinculación</option>
              <option value="Orientación">Orientación</option>
              <option value="Biblioteca">Biblioteca</option>
              <option value="Recursos Humanos">Recursos Humanos</option>
              <option value="Servicios docentes">Servicios docentes</option>
              <option value="Mantenimiento">Mantenimiento</option>
              <option value="Servicios Materiales">Servicios Materiales</option>
              <option value="Informatica">Informatica</option>
              <option value="Servicios escolares">Servicios escolares</option>
              <option value="Planeacion">Planeacion</option>
              <option value="Prefectura">Prefectura</option>
            </select>
          </div>
        </div>

        <div class="col-md-12 mt-4">
          <div>
            <label>Materiales a utilizar en</label>
            <textarea class="form-control" rows="3" name="materiales" required></textarea>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col">
            <div>
              <label>No. Prioridad</label>
              <input class="form-control" type="number" name="no_prioridad">
            </div>
          </div>

          <div class="col">
            <div>
              <label>Descripción</label>
              <input class="form-control" type="text" name="descripcion">
            </div>
          </div>

          <div class="col">
            <div>
              <label>Cantidad</label>
              <input class="form-control" min="1" type="number" name="cantidad" required>
            </div>    
          </div>

          <div class="col">
            <div>
              <label>Unidad</label>
              <input class="form-control" type="text" name="unidad">
            </div>
          </div>

          <div class="col">
            <div>
              <label>Importe Estimado</label>
              <input class="form-control" type="text" name="importe" required>
            </div>
          </div>
        </div>

        <div class="mt-3 d-flex justify-content-end">
          <button type="submit" class="btn btn-primary w-auto px-4">Agregar</button>
        </div>
      </form>

      
      <div class="mt-5 d-flex justify-content-center align-items-center gap-2">
        <div>
          <a href="./sendemail/requisicion-mail.php?perfil=DIRECTOR&id=<?php echo $user_id;?>" class="btn btn-outline-primary rounded-0 p-3">Enviar a Dirección</a>
        </div>

        <div>
          <a href="./sendemail/requisicion-mail.php?perfil=RECURSOSMATERIALES&id=<?php echo $user_id;?>" class="btn btn-outline-success rounded-0 p-3">Enviar a Recursos Materiales</a>
        </div>
        
      </div>

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