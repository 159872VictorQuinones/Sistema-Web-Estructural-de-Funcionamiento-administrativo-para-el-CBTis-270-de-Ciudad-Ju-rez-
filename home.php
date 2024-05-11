<?php 
 session_start();

 // revisamos si el usuario esta logeado, si no lo está redirigir a login
 if(!isset($_SESSION['ID'])) {
  header("Location: ./login.php");
  exit();
 }

 // incluimos la base de datos
 include('./db.php');
 $conn = mysqli_connect($host, $user, $pass, $db);

 // Muestra 3 últimos eventos próximos
 $results = mysqli_query($conn, "SELECT start, title, descripcion FROM eventos ORDER BY start DESC LIMIT 3");

 $images = mysqli_query($conn, "SELECT * FROM imagenes WHERE ID=1");
 $rowImg = mysqli_fetch_assoc($images);

 $imageBanner = $rowImg['imageBannerPath'];
 $image1 = $rowImg['imagePath1'];
 $image2 = $rowImg['imagePath2'];
 $image3 = $rowImg['imagePath3'];

 $page = "home";
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio - CBTis</title>
  <link href="./styles/styles.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
  <?php include('./components/header/index.php'); ?>
  <div class="pb-5">
    <div class="position-relative">
      <a href="https://cbtis270.tech/imagenes.php" class="btn btn-dark rounded-0">Editar imagenes</a>
      <img style="width: 100vw;" src="<?php echo $imageBanner;?>" class="img-fluid">
    </div>

    <div class="container mt-5">
      <div class="row">
        <div class="col">
          <?php
            setlocale(LC_TIME, 'es');

            foreach($results as $res) {    
              $date = $res['start'];
              $formatted_date = strftime('%e de %B del %Y', strtotime($date));

              echo '<div class="h4 py-3">'. $formatted_date . ' - ' . $res['title'] . '</div>';
            }
            
          ?>

          <div class="mt-4">
            <a href="./calendario.php" class="btn btn-dark btn-lg">EVENTOS PRÓXIMOS</a>
          </div>
        </div>

        <div class="col">
          <div class="row">
            <?php 
               for($i = 1; $i <= 3; $i++) {
                echo '<div class="col-4">';
                echo '<img class="img-fluid" src="' . ${'image' . $i} . '">';
                echo '</div>';
              }
            ?>
          </div>
        </div>
      </div> 
    </div>
  </div>
</body>
</html>