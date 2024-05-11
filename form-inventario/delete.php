<?php
  session_start();

  if(!isset($_SESSION['ID'])) {
    header("Location: ../index.php");
    exit();
  }

  // Recuperar ID del usuario en sesión
  $user_id = $_SESSION['ID'];

  include('../db.php');
  $conn = mysqli_connect($host, $user, $pass, $db);
  $id = $_GET['id'];

  $sql = "DELETE FROM inventario WHERE ID=$id";

  if (mysqli_query($conn, $sql)) {
    if($user_id == 1 || $user_id == 2) {
      header("Location: ../inventario-admin.php");
      exit();
    }
    header("Location: ../inventario.php");
    exit();
  } else {
    echo "<script>alert('Ha ocurrido un error al eliminar el registro.');</script>";
  }

  mysqli_close($conn);
?>