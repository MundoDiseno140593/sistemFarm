<?php 
include_once $_SERVER["DOCUMENT_ROOT"] . '/systemf/Model/proveedor.php';

$proveedor = new Proveedor();
session_start();

if ($_POST['funcion']=='buscar_datos') {
    $proveedor->buscar();
   
    
    $json=array();
    foreach ($proveedor->objetos as $objeto) {
 
        $json[]=array(

            'id'=>$objeto->id_proveedor,
            'proveedor'=>$objeto->marca,
            'contacto'=>$objeto->nombres,
            'apellido'=>$objeto->apellidos,
            'telefono'=>$objeto->telefono,
            'direccion'=>$objeto->direccion
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;

}


if ($_POST['funcion']=='crear_proveedor') {
    $proveedor1 = $_POST['proveedor'];
    $contacto=$_POST['contacto'];
    $apellido = $_POST['apellido'];
    $telefono=$_POST['telefono'];
    $direccion=$_POST['direccion'];
    $id_usuario=$_SESSION['usuario'];

    $proveedor->crear($proveedor1,$contacto,$apellido,$telefono,$direccion,$id_usuario);
   
}

if ($_POST['funcion']=='borrar'){
    $id=$_POST['id'];
    $proveedor->borrar($id);
}
 
if ($_POST['funcion']=='edito') {
    $id = $_POST['codproveedor'];
    $proveedor1 = $_POST['proveedor'];
    $contacto = $_POST['contacto'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $direccion=$_POST['direccion'];

    $proveedor->edit($id,$proveedor1,$contacto,$apellido,$telefono,$direccion);
    
}
  
if ($_POST['funcion']=='rellenar_proveedores'){
    $proveedor->rellenar_proveedores();
   
    $json=array();
    foreach ($proveedor->objetos as $objeto ) {
        $json[]=array(
            'id'=>$objeto->id_proveedor,
            'nombre'=>$objeto->marca
        );
    }
    $jsonstring=json_encode($json); 
    echo $jsonstring;
 }


?>