<?php
  session_start();

  if(!isset($_SESSION['ID'])) {
    header("Location: ./login.php");
  }

  $page = "calendario";
  
  // Obtener el ID del usuario en sesión
  $user_id = $_SESSION['ID'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calendario</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">  
  <link href="./styles/styles.css" rel="stylesheet">

  <script src="./js/jquery.min.js"></script>
  <script src="./js/moment.min.js"></script>

  <!-- Full Calendar -->
  <link rel="stylesheet" href="./styles/fullcalendar.min.css">
  <script src="./js/fullcalendar.min.js"></script>
  <script src="./js/es.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script></head>
<body>
  <?php include('./components/header/index.php'); ?>

  <div class="container my-5">    
    <div class="row d-flex justify-content-center">
      <div class="col-8">
        <div id="CalendarioWeb" class="bg-white p-4 rounded-lg"></div>
      </div>
    </div>
  </div>



  <script>
    $(document).ready(function() {
      $('#CalendarioWeb').fullCalendar({
        header: {
          left: 'today, prev, next',
          center: 'title',
          right: 'month'
        },
        dayClick: function(date, jsEvent, view) {
          // H2
          $('#tituloEvento').html('Nuevo Evento');

          $('#btnModificar').hide();
          $('#btnEliminar').hide();
          $('#btnAgregar').show();

          limpiarFormulario();
          $('#fecha').val(date.format());
          $("#ModalEventos").modal();
        },
        events: '/eventos.php',
        eventClick: function(calEvent, jsEvent, view) {
          $('#btnAgregar').hide();
          $('#btnModificar').show();
          $('#btnEliminar').show();

          // H2
          $('#tituloEvento').html(calEvent.title);

          // Mostrar la informacion del evento en los inputs
          $('#titulo').val(calEvent.title);
          $('#descripcion').val(calEvent.descripcion);
          $('#ID').val(calEvent.ID);
          $('#color').val(calEvent.color);

          FechaHora = calEvent.start._i.split(" ");
          $('#fecha').val(FechaHora[0]);
          $('#hora').val(FechaHora[1]);

          $('#ModalEventos').modal();
        }
       
      });
    });
  </script>

  <div class="modal fade" id="ModalEventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloEvento"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div>
            <input type="hidden" class="form-control" id="ID" name="ID">
          </div>

          <div>
            <input type="hidden" class="form-control" id="fecha" name="fecha">
          </div>

          <div>
            <label>Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo">
          </div>

          <div>
            <label>Hora del evento</label>
            <input type="time" class="form-control" id="hora" name="hora" value="10:30">
          </div>

          <div>
            <label>Descripción</label>
            <textarea rows="3" class="form-control" id="descripcion" name="descripcion"></textarea>
          </div>

          <div>
            <label>Color</label>
            <input type="color" class="form-control" id="color" name="color" value="#1a1a1a">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="btnAgregar">Agregar</button>
          <button type="button" class="btn btn-success" id="btnModificar">Editar</button>
          <button type="button" class="btn btn-danger" id="btnEliminar">Eliminar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    var nuevoEvento;
    $('#btnAgregar').click(function() {
      recolectarDatosGUI();
      EnviarInformacion('agregar', nuevoEvento);
    });

    $('#btnEliminar').click(function() {
      recolectarDatosGUI();
      EnviarInformacion('eliminar', nuevoEvento);
    });

    $('#btnModificar').click(function() {
      recolectarDatosGUI();
      EnviarInformacion('modificar', nuevoEvento);
    })

    // recolectamos los datos del formulario
    function recolectarDatosGUI() {
      nuevoEvento = {
        ID: $('#ID').val(), 
        title: $('#titulo').val(),
        start: $('#fecha').val() + " " + $('#hora').val(),
        color: $('#color').val(),
        descripcion: $('#descripcion').val(),
        textColor: "#fff",
        user_id: <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'null'; ?> // Pasar el user_id desde PHP
      };
    }

    // Enviamos informacion
    function EnviarInformacion(accion, objEvento) {
      $.ajax({
        type: 'POST',
        url: 'eventos.php?accion=' + accion,
        data: objEvento,
        success: function(msg) {
          if(msg) {
            $('#CalendarioWeb').fullCalendar('refetchEvents');
            $('#ModalEventos').modal('toggle');
          }
        },
        error: function() {
          alert('Hay un error..');
        }
      });
    }

    // Limpiamos el formulario
    function limpiarFormulario() {
      $('#titulo').val(''), 
      $('#color').val(''),
      $('#descripcion').val(''),
      $('#ID').val(''),
      $('#hora').val('10:30')
    }
  </script>
</body>
</html>