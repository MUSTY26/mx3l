<?php
include "includes/auth.php";
include "includes/db.php";
comprovar_rol(array("camioner", "admin"));
$sql = "SELECT comandes.*, clients.nom_comercial, estats_comanda.nom_estat FROM comandes INNER JOIN clients ON comandes.id_client = clients.id_client INNER JOIN estats_comanda ON comandes.id_estat = estats_comanda.id_estat WHERE estats_comanda.nom_estat = 'preparada' OR estats_comanda.nom_estat = 'en repartiment' ORDER BY comandes.data_comanda ASC";
$resultat = mysqli_query($connexio, $sql);
?>
<!DOCTYPE html>
<html lang="ca">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Camioner</title><link rel="stylesheet" href="assets/css/style.css"></head>
<body>
<section class="panell-top"><div class="contenidor"><h1>Panell de camioner</h1><p>Comandes preparades per repartir.</p></div></section>
<section class="seccio"><div class="contenidor">
    <div class="accions" style="margin-bottom:22px"><a class="boto boto-secundari" href="logout.php">Tancar sessió</a></div>
    <div class="taula-responsive"><table><tr><th>ID</th><th>Client</th><th>Data</th><th>Estat</th><th>Import</th><th>Accions</th></tr>
    <?php while ($comanda = mysqli_fetch_assoc($resultat)) { ?>
        <tr>
            <td><?php echo $comanda["id_comanda"]; ?></td>
            <td><?php echo $comanda["nom_comercial"]; ?></td>
            <td><?php echo $comanda["data_comanda"]; ?></td>
            <td><span class="estat"><?php echo $comanda["nom_estat"]; ?></span></td>
            <td><?php echo number_format($comanda["import_total"], 2); ?> €</td>
            <td>
                <form method="post" action="canviar_estat.php" class="accions">
                    <input type="hidden" name="id_comanda" value="<?php echo $comanda["id_comanda"]; ?>">
                    <input type="hidden" name="origen" value="camioner">
                    <button class="boto boto-secundari" name="nou_estat" value="en repartiment" type="submit">en repartiment</button>
                    <button class="boto boto-taronja" name="nou_estat" value="entregada" type="submit">entregada</button>
                    <button class="boto boto-secundari" name="nou_estat" value="incidència" type="submit">incidència</button>
                </form>
            </td>
        </tr>
    <?php } ?>
    </table></div>
</div></section>
</body>
</html>
