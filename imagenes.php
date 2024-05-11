<?php
  session_start();

  if(!isset($_SESSION['ID'])) {
    header("Location: ./login.php");
  }

  $page = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cambiar Imágenes</title>
  <link href="./styles/styles.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body>
  <?php include('./components/header/index.php'); ?>

  <div class="container my-5">
    <div class="row">
      <div class="col-8">
        <h1 class="h3">Cambiar Imágenes</h1>
        <form enctype="multipart/form-data" class="bg-white p-4 rounded-3 gap-3 row" action="./save-images.php" method="post">
          <div>
            <label>Cambiar Banner</label>
            <input type="file" class="form-control" name="imageBanner" accept="image/*">
          </div>
          <div>
            <label>Imagen 1</label>
            <input type="file" class="form-control" name="image1" accept="image/*">
          </div>
          <div>
            <label>Imagen 2</label>
            <input type="file" class="form-control" name="image2" accept="image/*">
          </div>
          <div>
            <label>Imagen 3</label>
            <input type="file" class="form-control" name="image3" accept="image/*">
          </div>
          <button type="submit" class="btn btn-primary">Subir Imágenes</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>