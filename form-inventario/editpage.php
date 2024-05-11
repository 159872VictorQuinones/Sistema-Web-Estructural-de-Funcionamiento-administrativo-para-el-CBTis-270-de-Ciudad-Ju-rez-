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

  $results = mysqli_query($conn, "SELECT * FROM inventario WHERE ID = $url_id");
  $row = mysqli_fetch_assoc($results);

  $page = "inventario";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Inventario</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link href="../styles/styles.css" rel="stylesheet">
</head>
<body>
  <?php include('../components/header/index.php') ?>

  <div class="container mt-4">
    <h1 class="h3">Editar Producto de Inventario</h1>
    <div class="h4 mb-3">No. Serie: <?php echo $row['no_serie']; ?></div>
    <form action="./edit.php?id=<?php echo $url_id;?>" method="post" class="rounded-2 form-edit d-flex bg-dark p-3 justify-content-center align-items-end gap-2 mb-2">
      <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
      <div>
        <label>No. Serie</label>
        <input 
          class="form-control bg-dark text-white" 
          required 
          name="no_serie" 
          placeholder="No. Serie" 
          type="text" 
          value="<?php echo $row['no_serie'] ?>">
      </div>
      <div>
        <label>Producto</label>
        <input 
          class="form-control bg-dark text-white" 
          required 
          name="producto" 
          placeholder="Producto" 
          type="text"
          value="<?php echo $row['producto'] ?>">
      </div>
      <div>
        <label>Marca</label>
        <input 
          class="form-control bg-dark text-white" 
          name="marca" 
          placeholder="Marca" 
          type="text"
          value="<?php echo $row['marca'] ?>">
      </div>
      <div>
        <label>Modelo</label>
        <input 
          class="form-control bg-dark text-white"
          name="modelo" 
          placeholder="Modelo" 
          type="text"
          value="<?php echo $row['modelo'] ?>">
      </div>
      <div>
        <label>Descripción</label>
        <input 
          class="form-control bg-dark text-white"
          name="descripcion" 
          placeholder="Descripción" 
          type="text"
          value="<?php echo $row['descripcion'] ?>">
      </div>
      <div>
        <label>Cantidad</label>
        <input 
          class="form-control bg-dark text-white" 
          required name="cantidad" 
          placeholder="Cantidad" 
          min="1"
          type="number"
          value="<?php echo $row['cantidad'] ?>">
      </div>
      <div>
        <label>Unidad</label>
        <input 
          class="form-control bg-dark text-white"
          required 
          name="unidad" 
          placeholder="Unidad" 
          type="text"
          value="<?php echo $row['unidad'] ?>">
      </div>
      <button class="btn btn-success">Editar</button>
    </form>
  </div>
</body>
</html>