<?php  

  $tipo_usuario_ID = $_SESSION['tipo_usuario_ID'];

  // Variables dinámicas
  $titulo = "CBTis 270";

  $inventario_url = "/inventario.php";
  $requisicion_url = "/requisicion.php";
  $soporte_url = "/soporte.php";
  $calendario_url = "/calendario.php";
  $contacto_url = "/contacto.php";
  $logout_url = "/logout.php";

  if($tipo_usuario_ID == 1 || $tipo_usuario_ID == 2) {
    $inventario_url = "/inventario-admin.php";
  }

  // Generar el contenido HTML
  $html = '
  <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container justify-content-end align-items-end">
      <div class="d-flex column justify-content-end align-items-end gap-3">
        <img src="/assets/img/toro.png" width="50" class="img-fluid">
        <a class="navbar-brand" href="./home.php" style="font-size: 28px;">' . $titulo . '</a>
      </div>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">';

        // Verifica la condición para ocultar el enlace de "Inventario"
        if ($tipo_usuario_ID != 15) {
          $html .= '<li class="nav-item">
                      <a class="h4 nav-link text-dark fw-bold font-weight-bold ' . ($page == 'inventario' ? 'active' : '') . '" aria-current="page" href="' . $inventario_url . '">Inventario</a>
                    </li>';
        }

        $html .= '
          <li class="nav-item">
            <a class="nav-link h4 text-dark fw-bold font-weight-bold ' . ($page == 'requisicion' ? 'active' : '') . '" href="' . $requisicion_url . '">Requisición</a>
          </li>
          <li class="nav-item">
            <a class="nav-link h4 text-dark fw-bold font-weight-bold ' . ($page == 'soporte' ? 'active' : '') . '" href="' . $soporte_url . '">Soporte</a>
          </li>
          <li class="nav-item">
            <a class="nav-link h4 text-dark fw-bold font-weight-bold ' . ($page == 'calendario' ? 'active' : '') . '" href="' . $calendario_url . '">Calendario</a>
          </li>
          <li class="nav-item">
            <a class="nav-link h4 text-dark fw-bold font-weight-bold ' . ($page == 'contacto' ? 'active' : '') . '" href="' . $contacto_url . '">Contacto</a>
          </li>
        </ul>
        <form class="d-flex justify-content-center align-items-center" action="' . $logout_url . '">
          <div class="me-3 bg-white rounded-1 px-4 py-2">' . $_SESSION['email'] . '</div>
          <button class="btn btn-danger" type="submit">Salir</button>
        </form>
      </div>
    </div>
  </nav>';

  // Imprimir el HTML
  echo $html;
?>
