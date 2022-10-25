<?php 
include_once $_SERVER["DOCUMENT_ROOT"] . '/systemf/Model/cliente.php';

$cliente = new Cliente();
session_start();

if ($_POST['funcion']=='buscar_datos') {

    $json=array();
 
    $cliente->buscar();
    
    foreach ($cliente->objetos as $objeto) {
 
        $json[]=array(

            'id'=>$objeto->id_cliente,
            'nit'=>$objeto->codigo,
            'nombre'=>$objeto->nombres,
            'apellido'=>$objeto->apellidos,
            'telefono'=>$objeto->telefono,
            'direccion'=>$objeto->direccion
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;

}


if ($_POST['funcion']=='crear_cliente') {
    $nit=$_POST['nit'];
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $telefono=$_POST['telefono'];
    $direccion=$_POST['direccion'];
    $id_usuario=$_SESSION['usuario'];

    $cliente->crear($nit,$nombre,$apellido,$telefono,$direccion,$id_usuario);
 }

 if ($_POST['funcion']=='borrar'){
    $id=$_POST['id'];
    $cliente->borrar($id);
 }

 if ($_POST['funcion']=='edito') {
    $id = $_POST['id_cliente'];
  
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $direccion=$_POST['direccion'];

    $cliente->edit($id,$nombre,$apellido,$telefono,$direccion);
    
}
  


?>