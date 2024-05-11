<?php

session_start();

if (!isset($_SESSION['ID'])) {
    header("Location: ./login.php");
    exit();
}

include('./db.php');

$conn = mysqli_connect($host, $user, $pass, $db);

// Verificar la conexión
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Consultar la base de datos para obtener las rutas de los archivos anteriores
$result = mysqli_query($conn, "SELECT * FROM imagenes WHERE ID=1");
$row = mysqli_fetch_assoc($result);
$oldImageBannerPath = $row['imageBannerPath'];
$oldImagePath1 = $row['imagePath1'];
$oldImagePath2 = $row['imagePath2'];
$oldImagePath3 = $row['imagePath3'];

// Verificar si se ha enviado una imagen de banner y guardar la ruta en la base de datos
if (isset($_FILES['imageBanner']) && $_FILES['imageBanner']['error'] === UPLOAD_ERR_OK) {
    // Ruta donde se guardará la imagen
    $carpeta_destino = "./assets/img/";

    // Generar un nombre único para la imagen de banner
    $nombre_imagen_banner = uniqid('imagen_banner_') . '_' . $_FILES['imageBanner']['name'];

    // Mover la imagen de banner al directorio de destino
    if (move_uploaded_file($_FILES['imageBanner']['tmp_name'], $carpeta_destino . $nombre_imagen_banner)) {
        // Guardar la ruta de la imagen de banner en la base de datos
        $imageBannerPath = $carpeta_destino . $nombre_imagen_banner;
   
        // Preparar la consulta para actualizar la ruta de la imagen de banner en la base de datos
        $sql = "UPDATE imagenes SET imageBannerPath='$imageBannerPath' WHERE ID=1";

        if (!mysqli_query($conn, $sql)) {
            echo "Error al actualizar la ruta de la imagen de banner en la base de datos: " . mysqli_error($conn);
            exit();
        }        
        // Eliminar el archivo anterior del sistema de archivo
        if (file_exists($oldImageBannerPath)) {
            unlink($oldImageBannerPath);
        }

    } else {
        echo "Error al subir la imagen de banner.";
        exit();
    }
}

// Verificar si se ha enviado alguna de las otras imágenes y guardar las rutas en la base de datos
for ($i = 1; $i <= 3; $i++) {
    $input_name = 'image' . $i;
    if (isset($_FILES[$input_name]) && $_FILES[$input_name]['error'] === UPLOAD_ERR_OK) {
        // Ruta donde se guardará la imagen
        $carpeta_destino = "./assets/img/";

        // Generar un nombre único para la imagen
        $nombre_imagen = uniqid('imagen_' . $i . '_') . '_' . $_FILES[$input_name]['name'];

        // Mover la imagen al directorio de destino
        if (move_uploaded_file($_FILES[$input_name]['tmp_name'], $carpeta_destino . $nombre_imagen)) {
            // Guardar la ruta de la imagen en la base de datos
            $imagePath = $carpeta_destino . $nombre_imagen;

            // Preparar la consulta para actualizar la ruta de la imagen en la base de datos
            $sql = "UPDATE imagenes SET imagePath$i='$imagePath' WHERE ID=1";

            if (!mysqli_query($conn, $sql)) {
                echo "Error al actualizar la ruta de la imagen $i en la base de datos: " . mysqli_error($conn);
                exit();
            }

            // Eliminar el archivo anterior del sistema de archivos
            $oldImagePath = $row["imagePath$i"];
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        } else {
            echo "Error al subir la imagen $i.";
            exit();
        }
    }
}

// Redireccionar después de realizar todas las actualizaciones
header("Location: ./home.php");

// Cerrar la conexión
mysqli_close($conn);
?>
