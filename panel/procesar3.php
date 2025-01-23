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
$membresia = $_REQUEST['membresia'];


$hashed_pass = password_hash($pass, PASSWORD_BCRYPT, ["cost" => 8]);


$query = "INSERT INTO users (full_name, email, password, membership, otp) VALUES ('$nombres', '$correo', '$hashed_pass', '$membresia', '$pass')";
mysqli_query($link, $query) or die(mysqli_error($link));

header("Location: clientes.php");
mysqli_close($link);


//esto para comparar la contraseña
/*if (password_verify($pass, $hashed_pass)) {
    // La contraseña es correcta
} else {
    // La contraseña es incorrecta
}*/
?>