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
$iduser = $_REQUEST['idus'];
$nombres = $_REQUEST['nombres'];
$correo = $_REQUEST['correo'];
$pass = $_REQUEST['pass'];
$membresia = $_REQUEST['membresia'];



if (!empty($pass)) {
    

    $hashed_pass = password_hash($pass, PASSWORD_BCRYPT, ["cost" => 8]);
   
    $query = "UPDATE profesionales SET full_name='$nombres', password='$hashed_pass', email='$correo', membership='$membresia', otp='$pass' WHERE id='$iduser'";
} else {
  
    $query = "UPDATE profesionales SET full_name='$nombres', email='$correo', membership='$correo' WHERE id='$iduser'";
}

mysqli_query($link, $query) or die(mysqli_error($link));

header("Location: profesionales.php");
mysqli_close($link);
?>