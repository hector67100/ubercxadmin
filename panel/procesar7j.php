<?php
include_once('php_lib/config.ini.php');
$link =  mysqli_connect(SERVIDOR_MYSQL, USUARIO_MYSQL, PASSWORD_MYSQL);
    if (!$link) {
        trigger_error('Error al conectar al servidor mysql: ');
    }
    // Seleccionar la base de datos activa
    $db_selected = mysqli_select_db($link,BASE_DATOS);
    if (!$db_selected) {
        trigger_error ('Error al conectar a la base de datos: ');
    }
	mysqli_set_charset($link,"utf8");

    $idUsuario=$_REQUEST['idus'];
	
    $query = "DELETE FROM provincia WHERE id = '".$idUsuario."'";

    mysqli_query($link, $query) or die(mysqli_error($link));
    
	header("Location: provincia.php");  
?>