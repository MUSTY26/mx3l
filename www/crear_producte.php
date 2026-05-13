<?php
include "includes/auth.php";
include "includes/db.php";
comprovar_rol(array("admin"));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = mysqli_real_escape_string($connexio, $_POST["nom"]);
    $categoria = mysqli_real_escape_string($connexio, $_POST["categoria"]);
    $format = mysqli_real_escape_string($connexio, $_POST["format"]);
    $preu_base = floatval($_POST["preu_base"]);
    $estoc = intval($_POST["estoc"]);
    $imatge = mysqli_real_escape_string($connexio, $_POST["imatge"]);
    $actiu = intval($_POST["actiu"]);

    $sql = "INSERT INTO productes (nom, categoria, format, preu_base, estoc, imatge, actiu) VALUES ('$nom', '$categoria', '$format', $preu_base, $estoc, '$imatge', $actiu)";
    mysqli_query($connexio, $sql);
    header("Location: admin_productes.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ca">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Crear producte</title><link rel="stylesheet" href="assets/css/style.css"></head>
<body>
<section class="seccio"><div class="contenidor" style="max-width:760px">
<form class="formulari" method="post" action="crear_producte.php">
    <h1 class="titol-seccio">Crear producte</h1>
    <label>Nom</label><input type="text" name="nom" required>
    <label>Categoria</label><input type="text" name="categoria" required>
    <label>Format</label><input type="text" name="format" required>
    <label>Preu base</label><input type="number" step="0.01" name="preu_base" required>
    <label>Estoc</label><input type="number" name="estoc" required>
    <label>Imatge</label><input type="text" name="imatge" required>
    <label>Actiu</label><select name="actiu"><option value="1">Sí</option><option value="0">No</option></select>
    <button class="boto boto-taronja" type="submit">Guardar</button>
    <a class="boto boto-secundari" href="admin_productes.php">Tornar</a>
</form>
</div></section>
</body>
</html>
