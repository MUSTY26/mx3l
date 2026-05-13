<?php
include "includes/auth.php";
include "includes/db.php";
comprovar_rol(array("admin"));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producte = intval($_POST["id_producte"]);
    $sql = "DELETE FROM productes WHERE id_producte = $id_producte";
    mysqli_query($connexio, $sql);
}
header("Location: admin_productes.php");
exit();
?>
