<?php
session_start();

if (!isset($_SESSION["id_usuari"])) {
    header("Location: login.php");
    exit();
}

function comprovar_rol($rols_permesos) {
    if (!in_array($_SESSION["rol"], $rols_permesos)) {
        header("Location: login.php");
        exit();
    }
}
?>
