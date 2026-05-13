<?php
include "includes/auth.php";
include "includes/db.php";
comprovar_rol(array("magatzem", "camioner", "admin"));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_comanda = intval($_POST["id_comanda"]);
    $nou_estat = mysqli_real_escape_string($connexio, $_POST["nou_estat"]);
    $origen = mysqli_real_escape_string($connexio, $_POST["origen"]);

    $sql_estat = "SELECT id_estat FROM estats_comanda WHERE nom_estat = '$nou_estat'";
    $resultat_estat = mysqli_query($connexio, $sql_estat);

    if (mysqli_num_rows($resultat_estat) == 1) {
        $estat = mysqli_fetch_assoc($resultat_estat);
        $id_estat = $estat["id_estat"];
        $sql = "UPDATE comandes SET id_estat = $id_estat WHERE id_comanda = $id_comanda";
        mysqli_query($connexio, $sql);
    }

    if ($origen == "camioner") {
        header("Location: camioner.php");
    } elseif ($origen == "admin") {
        header("Location: admin_comandes.php");
    } else {
        header("Location: magatzem.php");
    }
    exit();
}
header("Location: login.php");
exit();
?>
