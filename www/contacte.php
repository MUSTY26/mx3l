<?php include "includes/header.php"; ?>
<section class="seccio seccio-blanca">
    <div class="contenidor grid-2">
        <div>
            <h1 class="titol-seccio">Contacte</h1>
            <p><strong>Mx3L - Mustera Begudes i Distribució</strong></p>
            <p>Saragossa</p>
            <p>mx3l.cat</p>
            <p>info@mx3l.cat</p>
            <p>Telèfon: 900 926 177</p>
        </div>
        <form class="formulari" method="post" action="contacte.php">
            <label>Nom</label>
            <input type="text" name="nom" required>
            <label>Email</label>
            <input type="email" name="email" required>
            <label>Missatge</label>
            <textarea name="missatge" required></textarea>
            <button class="boto boto-taronja" type="submit">Enviar</button>
        </form>
    </div>
</section>
<?php include "includes/footer.php"; ?>
