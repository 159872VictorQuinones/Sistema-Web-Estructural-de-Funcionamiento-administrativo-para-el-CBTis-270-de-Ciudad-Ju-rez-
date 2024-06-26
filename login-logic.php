<?php 
    include('./db.php');
    session_start();

    // Conexión a la base de datos
    $conn = mysqli_connect($host, $user, $pass, $db);


    // Por si falla la conexión
    if (!$conn) {
        die("Conexión fallida: " . mysqli_connect_error());
    }
    
    // Recuperar datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Crear array vacio para almacenar los errores
    $errores = array();  

    // Consulta a base de datos
    $sql = "SELECT ID, email, password, tipo_usuario_ID FROM usuarios WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    
    // Verificar credenciales
    if (mysqli_num_rows($result) == 1) {
        // Inicio de sesión exitoso
        $row = mysqli_fetch_assoc($result);
        $_SESSION['ID'] = $row['ID'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['tipo_usuario_ID'] = $row['tipo_usuario_ID'];
        
        header("Location: ./home.php");
        exit();
    } else {
        // Credenciales incorrectas
        $errores['password'] = "Usuario o contraseña son incorrectos";
        include('./login.php');
        exit();
    }
    
    mysqli_close($conn);
?>