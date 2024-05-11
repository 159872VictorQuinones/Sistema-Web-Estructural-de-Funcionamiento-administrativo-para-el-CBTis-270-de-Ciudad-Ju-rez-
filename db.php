<?php
$host = "localhost";
$user = "u378975529_STYTECH";
$pass = "@Stytech159872";
$db = "u378975529_sistema_cbtis";

$bd = mysqli_connect($host, $user, $pass, $db) ;


if (mysqli_connect_errno())
{
    echo "Fallo la conexión a la base de datos: " . mysqli_connect_error();
}

mysqli_close($bd);
?>