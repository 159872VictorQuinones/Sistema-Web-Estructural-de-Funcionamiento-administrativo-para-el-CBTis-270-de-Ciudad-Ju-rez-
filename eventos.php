<?php
  header('Content-Type: application/json');
  $pdo = new PDO("mysql:dbname=u378975529_sistema_cbtis;host=localhost", "u378975529_STYTECH", "@Stytech159872");

  $accion = (isset($_GET['accion'])) ? $_GET['accion'] : 'leer';
  
  switch($accion) {
    case 'agregar':
      // Agregamos datos del formulario en nuestra base de datos
      $sentenciaSQL = $pdo->prepare("INSERT INTO 
      eventos(title,descripcion,color,textColor,start)
      VALUES(:title,:descripcion,:color,:textColor,:start)");

      $respuesta=$sentenciaSQL->execute(array(
        "title" => $_POST['title'],
        "descripcion" => $_POST['descripcion'],
        "color" => $_POST['color'],
        "textColor" => $_POST['textColor'],
        "start" => $_POST['start']
      ));

      echo json_encode($respuesta);

      break;
    case 'eliminar':
      // Eliminamos por ID el evento de la base de datos
      $respuesta=false;
      
      if(isset($_POST['ID'])) {
        $sentenciaSQL=$pdo->prepare("DELETE FROM eventos WHERE ID=:ID");
        $respuesta=$sentenciaSQL->execute(array("ID"=>$_POST['ID']));
      }

      echo json_encode($respuesta);

      break;
    case 'modificar':
      // Actualizamos datos en la base de datos
      $sentenciaSQL=$pdo->prepare("UPDATE eventos SET 
        title=:title,
        descripcion=:descripcion,
        color=:color,
        textColor=:textColor,
        start=:start
        WHERE ID=:ID
      ");

      $respuesta=$sentenciaSQL->execute(array(
        "ID" => $_POST['ID'],
        "title" => $_POST['title'],
        "descripcion" => $_POST['descripcion'],
        "color" => $_POST['color'],
        "textColor" => $_POST['textColor'],
        "start" => $_POST['start']
      ));

      echo json_encode($respuesta);
      break;
    default:    
      // Seleccionar los eventos del calendario
        $sentenciaSQL = $pdo->prepare("SELECT * FROM eventos");
        $sentenciaSQL->execute();

        $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
      break;
  }


?>