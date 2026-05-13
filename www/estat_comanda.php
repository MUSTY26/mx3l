<?php
include "includes/auth.php";
include "includes/db.php";
comprovar_rol(array("client", "client_especial"));
$id_usuari = $_SESSION["id_usuari"];
$sql = "SELECT comandes.*, estats_comanda.nom_estat FROM comandes INNER JOIN clients ON comandes.id_client = clients.id_client INNER JOIN estats_comanda ON comandes.id_estat = estats_comanda.id_estat WHERE clients.id_usuari = $id_usuari ORDER BY comandes.data_comanda DESC";
$resultat = mysqli_query($connexio, $sql);
?>
<!DOCTYPE html>
<html lang="ca">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Estat de comandes</title><link rel="stylesheet" href="assets/css/style.css"></head>
<body>
<section class="panell-top"><div class="contenidor"><h1>Estat de comandes</h1><p>Consulta les teves comandes registrades.</p></div></section>
<section class="seccio"><div class="contenidor">
    <div class="accions" style="margin-bottom:22px"><a class="boto boto-secundari" href="panell_client.php">Tornar al panell</a></div>
    <div class="taula-responsive"><table><tr><th>ID</th><th>Data</th><th>Estat</th><th>Import total</th><th>Observacions</th></tr>
    <?php while ($comanda = mysqli_fetch_assoc($resultat)) { ?>
        <tr><td><?php echo $comanda["id_comanda"]; ?></td><td><?php echo $comanda["data_comanda"]; ?></td><td><span class="estat"><?php echo $comanda["nom_estat"]; ?></span></td><td><?php echo number_format($comanda["import_total"], 2); ?> €</td><td><?php echo $comanda["observacions"]; ?></td></tr>
    <?php } ?>
    </table></div>
</div></section>
</body>
</html>
