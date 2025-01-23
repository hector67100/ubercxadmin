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

$idCategoria = $_REQUEST['idus']; // Obtener el ID de la categoría a editar
$nombres = $_REQUEST['clave'];
$descripcion = $_REQUEST['valor'];
$visible = $_REQUEST['visible'];

$query = "UPDATE detalles SET clave = '$nombres', descripcion = '$descripcion', visible = '$visible' WHERE id = '$idCategoria'";
mysqli_query($link, $query) or die(mysqli_error($link));


if($nombres=="1"){header("Location: edad.php");}
if($nombres=="2"){header("Location: detalles.php");}
if($nombres=="3"){header("Location: cabello.php");}
if($nombres=="4"){header("Location: piel.php");}
if($nombres=="5"){header("Location: complexion.php");}
if($nombres=="6"){header("Location: peso.php");}
if($nombres=="7"){header("Location: altura.php");}
if($nombres=="8"){header("Location: medidap.php");}
mysqli_close($link);
?>