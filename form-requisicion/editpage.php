<?php
  session_start();

  // Si usuario no está logeado redirigir a login
  if(!isset($_SESSION)){
    header("Location: ./login.php");
  }

  include('../db.php');
  $conn = mysqli_connect($host, $user, $pass, $db);

  if (mysqli_connect_errno())
  {
    echo "Fallo la conexion a la base de datos: " . mysqli_connect_error();
  } 

  // Recuperar ID de la sesión
  $user_id = $_SESSION['ID'];
  $url_id = $_GET['id'];

  $results = mysqli_query($conn, "SELECT * FROM requisicion WHERE ID = $url_id");
  $row = mysqli_fetch_assoc($results);

  $page = "requisicion";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Requisición</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link href="../styles/styles.css" rel="stylesheet">
</head>
<body>
  <?php include('../components/header/index.php') ?>

  <div class="container mt-4">
    <h1 class="h3">Editar Requisición</h1>

    <form action="./edit.php?id=<?php echo $url_id;?>" method="post" class="row">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <div class="col-md-6">
          <div>
            <label>Fecha</label>
            <input class="form-control" type="date" name="fecha" required value="<?php echo $row['fecha'];?>"|>
          </div>
        </div>
     
        <div class="col-md-6">
          <div>
            <label>Departamento</label>
            <select class="form-control" name="departamento" required value="<?php echo $row['departamento'];?>">
            <option value="">Seleccionar departamento</option>
              <?php
              $opciones = array(
                  "Personal Docente",
                  "Subdirección academica",
                  "Subdirección administrativa",
                  "Dirección",
                  "Control escolar",
                  "Vinculación",
                  "Orientación",
                  "Biblioteca",
                  "Recursos Humanos",
                  "Servicios docentes",
                  "Mantenimiento",
                  "Servicios Materiales",
                  "informatica"
              );

              foreach ($opciones as $opcion) {
                  echo "<option value='$opcion'";
                  if ($row['departamento'] == $opcion) {
                      echo " selected";
                  }
                  echo ">$opcion</option>";
              }
              ?>
            </select>
          </div>
        </div>

        <div class="col-md-12 mt-4">
          <div>
            <label>Materiales a utilizar en</label>
            <textarea rows="3" class="form-control" name="materiales" required><?php echo $row['materiales'];?></textarea>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col">
            <div>
              <label>No. Prioridad</label>
              <input class="form-control" type="number" name="no_prioridad" value="<?php echo $row['no_prioridad'];?>">
            </div>
          </div>

          <div class="col">
            <div>
              <label>Descripción</label>
              <input class="form-control" type="text" name="descripcion" value="<?php echo $row['descripcion'];?>">
            </div>
          </div>

          <div class="col">
            <div>
              <label>Cantidad</label>
              <input class="form-control" min="1" type="number" name="cantidad" required value="<?php echo $row['cantidad'];?>">
            </div>    
          </div>

          <div class="col">
            <div>
              <label>Unidad</label>
              <input class="form-control" type="text" name="unidad" value="<?php echo $row['unidad'];?>">
            </div>
          </div>

          <div class="col">
            <div>
              <label>Importe Estimado</label>
              <input class="form-control" type="text" name="importe" required value="<?php echo $row['importe'];?>">
            </div>
          </div>
        </div>

        <div class="mt-3 d-flex justify-content-end">
          <button type="submit" class="btn btn-success w-auto px-4">Editar</button>
        </div>
      </form>
  </div>
</body>
</html>