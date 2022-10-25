<?php 
include '../Model/entrada.php';
$entrada = new Entrada();
session_start();
$id_usuario = $_SESSION['usuario'];

if ($_POST['funcion']=='crear') {
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
    $id_usuario = $_SESSION['usuario'];

    $entrada->crear_lote($id_producto,$cantidad,$precio,$id_usuario);
   
}




?>