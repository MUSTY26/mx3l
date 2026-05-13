<?php
include "includes/auth.php";
include "includes/db.php";
comprovar_rol(array("admin"));
$id_producte = intval($_GET["id_producte"]);
$resultat = mysqli_query($connexio, "SELECT * FROM productes WHERE id_producte = $id_producte");
$producte = mysqli_fetch_assoc($resultat);
?>
<!DOCTYPE html>
<html lang="ca">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Editar producte</title><link rel="stylesheet" href="assets/css/style.css"></head>
<body>
<section class="seccio"><div class="contenidor" style="max-width:760px">
<form class="formulari" method="post" action="actualitzar_producte.php">
    <h1 class="titol-seccio">Editar producte</h1>
    <input type="hidden" name="id_producte" value="<?php echo $producte["id_producte"]; ?>">
    <label>Nom</label><input type="text" name="nom" value="<?php echo $producte["nom"]; ?>" required>
    <label>Categoria</label><input type="text" name="categoria" value="<?php echo $producte["categoria"]; ?>" required>
    <label>Format</label><input type="text" name="format" value="<?php echo $producte["format"]; ?>" required>
    <label>Preu base</label><input type="number" step="0.01" name="preu_base" value="<?php echo $producte["preu_base"]; ?>" required>
    <label>Estoc</label><input type="number" name="estoc" value="<?php echo $producte["estoc"]; ?>" required>
    <label>Actiu</label><select name="actiu"><option value="1" <?php if ($producte["actiu"] == 1) { echo "selected"; } ?>>Sí</option><option value="0" <?php if ($producte["actiu"] == 0) { echo "selected"; } ?>>No</option></select>
    <button class="boto boto-taronja" type="submit">Actualitzar</button>
    <a class="boto boto-secundari" href="admin_productes.php">Tornar</a>
</form>
</div></section>
</body>
</html>
