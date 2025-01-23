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

$clave = $_REQUEST['clave'];
$descripcion = $_REQUEST['valor'];
$visible = $_REQUEST['visible'];

$query = "INSERT INTO detalles (clave, descripcion, visible) VALUES ('$clave', '$descripcion', '$visible')";
mysqli_query($link, $query) or die(mysqli_error($link));



if($clave=="1"){header("Location: edad.php");}
if($clave=="2"){header("Location: detalles.php");}
if($clave=="3"){header("Location: cabello.php");}
if($clave=="4"){header("Location: piel.php");}
if($clave=="5"){header("Location: complexion.php");}
if($clave=="6"){header("Location: peso.php");}
if($clave=="7"){header("Location: altura.php");}
if($clave=="8"){header("Location: medidap.php");}


mysqli_close($link);
?>