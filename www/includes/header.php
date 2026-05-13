<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mx3L - Mustera Begudes i Distribució</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="capcalera">
    <div class="contenidor capcalera-flex">
        <a href="index.php" class="logo">
            <img src="assets/img/logo.png" alt="Mx3L" onerror="this.style.display='none'">
            <span>Mx3L</span>
        </a>
        <nav class="menu">
            <a href="index.php">Inici</a>
            <a href="qui-som.php">Qui som</a>
            <a href="serveis.php">Serveis</a>
            <a href="sucursal.php">Sucursal</a>
            <a href="contacte.php">Contacte</a>
        </nav>
        <a class="boto boto-taronja" href="login.php">Portal clients</a>
    </div>
</header>
<main>
