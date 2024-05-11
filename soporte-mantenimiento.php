<?php
  session_start();
  $page = "soporte";

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soporte Técnico de Mantenimiento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="./styles/styles.css" rel="stylesheet">
  </head>
  <body>
    <?php include('./components/header/index.php'); ?>

    <div class="container my-5">
      <h1 class="h4 mb-3">Reportar problema a soporte técnico de mantenimiento</h1>
      <form class="row bg-white p-4 rounded-3" action="./sendemail/email-soporte-mantenimiento.php" method="post">
        <div class="col-6">
          <label>Nombre del Solicitante</label>
          <input class="form-control" required name="nombreSolicitante" type="text" placeholder="Nombre Completo">
        </div>

        <div class="col-6">
          <label>Turno</label>
          <select class="form-control" required name="turno">
            <option value="">Seleccionar turno</option>
            <option value="Vespertino">Vespertino</option>
            <option value="Matutino">Matutino</option>
          </select>
        </div>

        <div class="mt-3 col-6">
          <label>Departamento</label>
          <select class="form-control" required name="departamento">
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
          </select>      
        </div>

        <div class="mt-3 col-6">
          <label>Otro</label>
          <input type="text" name="otroDepartamento" class="form-control" placeholder="Otro departamento">
        </div>

        <div class="mt-3 col-6">
          <label>Problema a resolver</label>
          <select class="form-control" required name="problema">
            <option value="">Seleccionar problema a resolver</option>
            <option value="Fuga de agua">Fuga de agua</option>
            <option value="puerta dañada">puerta dañada</option>
            <option value="Mantenimiento minisplit">Mantenimiento minisplit</option>
            <option value="Afectacion en baños">Afectacion en baños</option>
            <option value="pintura en edificios">pintura en edificios</option>
            <option value="Remplazo luminaria">Remplazo luminaria</option>
            <option value="Remplazo toma electrica">Remplazo toma electrica</option>
            <option value="Trabajo de soldadura">Trabajo de soldadura</option>
            <option value="Afectacion en ventana">Afectacion en ventana</option>
            <option value="Falta de energia electrica">Falta de energia electrica</option>
            <option value="Corto circuito">Corto circuito</option>
            <option value="Peticion de materiales">Peticion de materiales</option>
          </select>     
        </div>

        <div class="mt-3 col-6">
          <label>Otro</label>
          <input type="text" name="otroProblema" class="form-control" placeholder="Otro problema">
        </div>

        <div class="mt-3">
          <label>Más detalles de la situación a reportar (opcional)</label>
          <input type="text" name="masDetalles" class="form-control" placeholder="Detalla tu problema a resolver">
        </div>
        <button type="submit" class="mt-4 ms-3 btn btn-primary w-auto">Enviar</button>
      </form>
    </div>
    
  </body>
</html>