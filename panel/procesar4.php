<?php
include_once('php_lib/config.ini.php');
$link = mysqli_connect(SERVIDOR_MYSQL, USUARIO_MYSQL, PASSWORD_MYSQL);
if (!$link) {
    trigger_error('Error al conectar al servidor mysql: ');
}
// Seleccionar la base de datos activa
$db_selected = mysqli_select_db($link, BASE_DATOS);
if (!$db_selected) {
    trigger_error('Error al conectar a la base de datos: ');
}
mysqli_set_charset($link, "utf8");

$nombres = $_REQUEST['nombres'];
$correo = $_REQUEST['correo'];
$pass = $_REQUEST['pass'];


// Encriptar la contraseña usando bcrypt


$query = "INSERT INTO administrador (nombres, email, pass) VALUES ('$nombres', '$correo', '$pass')";
mysqli_query($link, $query) or die(mysqli_error($link));

header("Location: administrador.php");
mysqli_close($link);


//esto para comparar la contraseña
/*if (password_verify($pass, $hashed_pass)) {
    // La contraseña es correcta
} else {
    // La contraseña es incorrecta
}*/
?>