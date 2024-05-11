<?php
  session_start();
  include_once('C:/xampp/htdocs/cbtis-sistema/constants.php');

  if(!isset($_SESSION['ID'])) {
    header("Location: ../login.php");
    exit();
  }

  include('../db.php');

  $conn = mysqli_connect($host, $user, $pass, $db) ;

  // Recuperar datos del formulario
  $no_serie = $_POST['no_serie'];
  $producto = $_POST['producto'];
  $marca = $_POST['marca'];
  $modelo = $_POST['modelo'];
  $descripcion = $_POST['descripcion'];
  $cantidad = $_POST['cantidad'];
  $unidad = $_POST['unidad'];
  $user_id = $_POST['user_id'];
  
  $sql = "INSERT INTO 
      inventario (no_serie, producto, marca, modelo, descripcion, cantidad, unidad, user_id) 
    VALUES ('$no_serie','$producto', '$marca', '$modelo', '$descripcion', '$cantidad', '$unidad', '$user_id')";

  

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