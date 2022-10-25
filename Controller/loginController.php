<?php
include_once '../Model/usuario.php';
session_start();
$user = $_POST['user'];
$pass = $_POST['pass'];

$usuario = new Usuario(); 

$usuario->logo($user, $pass);
if (!empty($_SESSION['id_tipo'])) {
 
    switch ($_SESSION['id_tipo']) {
        case '1':
            header('location: ../View/bienvenido.php');
            break;
        
        case '2':
            header('location: ../View/bienvenido.php');
            break;

        case '3':
            header('location: ../View/bienvenido.php');
            break;
    }
}else {
if (!empty($usuario->objetos)) {
    foreach ($usuario->objetos as $objeto) {
        $_SESSION['usuario'] = $objeto->id_usuario;
        $_SESSION['id_tipo'] = $objeto->id_tipo;
        $_SESSION['nombre'] = $objeto->nomb;
    }
    switch ($_SESSION['id_tipo']){
        case 1:
            header('Location:../View/bienvenido.php');
            break;
        case 2:
            header('Location:../View/bienvenido.php');
            break;
        case 3:
            header('Location:../View/bienvenido.php');
            break;
    }

}
else{
    header('Location:../index.php');
}
}





?>