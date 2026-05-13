<?php
$servidor = "localhost";
$usuari = "mx3l";
$contrasenya = "Mm837674$";
$base_dades = "mx3l";

$connexio = mysqli_connect($servidor, $usuari, $contrasenya, $base_dades);

if (!$connexio) {
    die("Error de connexió: " . mysqli_connect_error());
}

mysqli_set_charset($connexio, "utf8mb4");
?>
