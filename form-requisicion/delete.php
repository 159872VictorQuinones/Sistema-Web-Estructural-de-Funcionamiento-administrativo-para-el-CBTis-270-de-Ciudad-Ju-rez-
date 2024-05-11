<?php
  session_start();
  include_once('C:/xampp/htdocs/cbtis-sistema/constants.php');

  if(!isset($_SESSION['ID'])) {
    header("Location: ../index.php");
    exit();
  }

  // Recuperar ID del usuario en sesión
  $user_id = $_SESSION['ID'];

  include('../db.php');
  
  $conn = mysqli_connect($host, $user, $pass, $db);
  $id = $_GET['id'];

  $sql = "DELETE FROM requisicion WHERE ID=$id";

  if (mysqli_query($conn, $sql)) {
    header("Location: ../requisicion-crear.php");
    exit();
  } else {
    echo "<script>alert('Ha ocurrido un error al eliminar el registro.');</script>";
  }

  mysqli_close($conn);
?>