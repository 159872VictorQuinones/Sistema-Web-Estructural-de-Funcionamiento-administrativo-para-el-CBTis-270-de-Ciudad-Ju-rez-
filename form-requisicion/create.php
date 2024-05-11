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
  $fecha = $_POST['fecha'];
  $materiales = $_POST['materiales'];
  $departamento = $_POST['departamento'];
  $no_prioridad = $_POST['no_prioridad'];
  $descripcion = $_POST['descripcion'];
  $cantidad = $_POST['cantidad'];
  $unidad = $_POST['unidad'];
  $importe = $_POST['importe'];
  $user_id = $_POST['user_id'];
  
  
  $sql = "INSERT INTO 
      requisicion (fecha, materiales, departamento, no_prioridad, descripcion, cantidad, unidad, user_id, importe) 
    VALUES ('$fecha','$materiales', '$departamento', '$no_prioridad', '$descripcion', '$cantidad', '$unidad', '$user_id', '$importe')";

    if (mysqli_query($conn, $sql)) {
      header("Location: ../requisicion-crear.php");
      exit();
    } else {
      echo "Error al registrar: " . mysqli_error($conn);
    }
?>