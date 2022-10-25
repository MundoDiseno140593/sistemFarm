<?php 
include_once $_SERVER["DOCUMENT_ROOT"] . '/systemf/Model/usuario.php';

$usuario = new Usuario();
session_start();


if ($_POST['funcion']=='buscar_datos') {

    $json=array();
 
    $usuario->buscar();
    
    foreach ($usuario->objetos as $objeto) {
 
        $json[]=array(

            'id'=>$objeto->id_usuario,
            'nombre'=>$objeto->nombre,
            'correo'=>$objeto->correo,
            'usuario'=>$objeto->usuario,
            'tipo'=>$objeto->nombre_tipo,
            'tipo_usuario'=>$objeto->id_tipo
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;

}


if ($_POST['funcion']=='crear_usuario') {
    $nombre=$_POST['nombre'];
    $correo=$_POST['correo'];
    $user=$_POST['usuario'];
    $clave=$_POST['clave'];
    $id_tipo=$_POST['id_tipo'];

    $usuario->crear($nombre,$correo,$user,$clave,$id_tipo);
 }

 if ($_POST['funcion']=='borrar'){
    $id=$_POST['id'];
    $usuario->borrar($id);
 }

 if ($_POST['funcion']=='edito') {
    $id = $_POST['id_usuario'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $id_tipo=$_POST['id_tipo'];

    $usuario->edit($id,$nombre,$correo,$id_tipo);
    
}
  


?>