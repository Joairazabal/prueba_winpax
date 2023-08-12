<?php
include("db.php");


if (!$_POST['nombre'] || !$_POST['apellido'] || !$_POST['correo'] || !$_POST['password'] || !$_POST['passwordConfirm']) {
    $_SESSION['message'] = "Todos los campos son obligatorios";
    return header("Location: index.php");
}

$name = $_POST['nombre'];
$surname = $_POST['apellido'];
$email = $_POST['correo'];
$password = $_POST['password'];
$passwordConfirm = $_POST['passwordConfirm'];

if (strlen($email) > 0 && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['message'] = "Ingresar un correo correcto";
    return header("Location: index.php");
}

if ($password != $passwordConfirm) {
    $_SESSION['message'] = "Las contraseñas no coinciden";
    return  header("Location: index.php");
}

$queryFilterUsers = "SELECT * FROM `users` where `email` = '$email'";
$emailResult = mysqli_query($conn, $queryFilterUsers);

if (!$emailResult) {
    echo "Error en la consulta: " . mysqli_error($conn);
    return header("Location: index.php");
}
if ($emailResult->num_rows > 0) {
    $_SESSION['message'] = "Ya esta registrado este correo";
    return header("Location: index.php");
}
$passHash = password_hash($password, PASSWORD_DEFAULT);
$queryForSave = "INSERT INTO `users`(`name`,`surname`,`email`,`password`) VALUES('$name','$surname','$email','$passHash')";
$resultSave = mysqli_query($conn, $queryForSave);

if (isset($resultSave)) {
     $_SESSION['message'] = "Creado con éxito";
    return header("Location: index.php");
}
echo "Error en la consulta al guardar: " . mysqli_error($conn);

?>