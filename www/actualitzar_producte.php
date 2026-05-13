<?php
include "includes/auth.php";
include "includes/db.php";
comprovar_rol(array("admin"));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producte = intval($_POST["id_producte"]);
    $nom = mysqli_real_escape_string($connexio, $_POST["nom"]);
    $categoria = mysqli_real_escape_string($connexio, $_POST["categoria"]);
    $format = mysqli_real_escape_string($connexio, $_POST["format"]);
    $preu_base = floatval($_POST["preu_base"]);
    $estoc = intval($_POST["estoc"]);
    $actiu = intval($_POST["actiu"]);

$sql = "UPDATE productes SET nom = '$nom', categoria = '$categoria', format = '$format', preu_base = '$preu_base', estoc = '$estoc', actiu = '$actiu' WHERE id_producte = $id_producte";
mysqli_query($connexio, $sql);

}
header("Location: admin_productes.php");
exit();
?>
