<?php
include "includes/auth.php";
include "includes/db.php";
comprovar_rol(array("admin"));
$resultat = mysqli_query($connexio, "SELECT * FROM productes ORDER BY id_producte DESC");
?>
<!DOCTYPE html>
<html lang="ca">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Admin productes</title><link rel="stylesheet" href="assets/css/style.css"></head>
<body>
<section class="panell-top"><div class="contenidor"><h1>Administració de productes</h1><p>CRUD bàsic del catàleg.</p></div></section>
<section class="seccio"><div class="contenidor">
    <div class="accions" style="margin-bottom:22px"><a class="boto boto-taronja" href="crear_producte.php">Crear producte</a><a class="boto boto-secundari" href="admin_comandes.php">Admin comandes</a><a class="boto boto-secundari" href="logout.php">Tancar sessió</a></div>
    <div class="taula-responsive"><table><tr><th>ID</th><th>Nom</th><th>Categoria</th><th>Format</th><th>Preu</th><th>Estoc</th><th>Actiu</th><th>Accions</th></tr>
    <?php while ($producte = mysqli_fetch_assoc($resultat)) { ?>
        <tr>
            <td><?php echo $producte["id_producte"]; ?></td>
            <td><?php echo $producte["nom"]; ?></td>
            <td><?php echo $producte["categoria"]; ?></td>
            <td><?php echo $producte["format"]; ?></td>
            <td><?php echo number_format($producte["preu_base"], 2); ?> €</td>
            <td><?php echo $producte["estoc"]; ?></td>
            <td><?php echo $producte["actiu"]; ?></td>
            <td class="accions">
                <a class="boto boto-secundari" href="editar_producte.php?id_producte=<?php echo $producte["id_producte"]; ?>">Editar</a>
                <form method="post" action="eliminar_producte.php">
                    <input type="hidden" name="id_producte" value="<?php echo $producte["id_producte"]; ?>">
                    <button class="boto boto-taronja" type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
    <?php } ?>
    </table></div>
</div></section>
</body>
</html>
