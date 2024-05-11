<?php
  session_start();

  if(!isset($_SESSION['ID'])) {
    header("Location: ../login.php");
    exit();
  }

  include('../db.php');

  $conn = mysqli_connect($host, $user, $pass, $db) ;

  // obtener ID de la URL
  $url_ID = $_GET['id'];

  // Recuperar datos del formulario
  $no_serie = $_POST['no_serie'];
  $producto = $_POST['producto'];
  $marca = $_POST['marca'];
  $modelo = $_POST['modelo'];
  $descripcion = $_POST['descripcion'];
  $cantidad = $_POST['cantidad'];
  $unidad = $_POST['unidad'];
  $user_id = $_POST['user_id'];
  
  $sql = "UPDATE 
            inventario 
          SET
            no_serie='$no_serie', producto='$producto', marca='$marca', modelo='$modelo', descripcion='$descripcion', cantidad='$cantidad', unidad='$unidad' 
          WHERE
            ID = $url_ID";

    if (mysqli_query($conn, $sql)) {
      if($user_id == 1 || $user_id == 2) {
        header("Location: ../inventario-admin.php");
        exit();
      }
      header("Location: ../inventario.php");
      exit();
    } else {
      echo "Error al registrar: " . mysqli_error($conn);
    }
?>