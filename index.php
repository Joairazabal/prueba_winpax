<?php
include("db.php");
include("header.php");
?>

<form action="save.php" method="POST">

    <label>Nombre</label>
    <input type="text" name="nombre">
    <label>apellido</label>
    <input type="text" name="apellido">
    <label>Correo</label>
    <input type="text" name="correo">
    <label>Contraseña</label>
    <input type="password" name="password">
    <label>Confirma ontraseña</label>
    <input type="password" name="passwordConfirm">
    <button type="submit">enviar</button>
    <?php if (isset($_SESSION['message'])) { ?>
        <span><?= $_SESSION['message'] ?></span>
    <?php
        session_unset();
    } ?>
</form>


<?php include("footer.php") ?>