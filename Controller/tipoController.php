<?php 
include_once $_SERVER["DOCUMENT_ROOT"] . '/systemf/Model/tipo.php';

$tipo = new Tipo();
session_start();

if ($_POST['funcion']=='rellenar_tipo'){
    $tipo->rellenar_tipo();

    $json=array();
 
    foreach ($tipo->objetos as $objeto ) {
        $json[]=array(
            'id_tip'=>$objeto->id,
            'nombre'=>$objeto->nombre_tipo
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
 }

 if ($_POST['funcion']=='rellenar_tipo_edit'){
    $tipo->rellenar_tipo_edit();

    $json=array();
 
    foreach ($tipo->objetos as $objeto ) {
        $json[]=array(
            'id_tip'=>$objeto->id,
            'nombre'=>$objeto->nombre_tipo
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
 }


?>