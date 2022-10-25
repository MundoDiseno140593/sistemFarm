<?php
include_once 'conexion.php';

class Tipo{
 var $objetos;

 public function __construct()
 {
     $db = new Conexion();
     $this->acceso = $db->pdo;
 }

 function rellenar_tipo(){
    $sql="SELECT *
    FROM
	tipo ORDER BY nombre_tipo ASC";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos=$query->fetchall();
    return $this->objetos;
}

function rellenar_tipo_edit(){
    $sql="SELECT *
    FROM
	tipo ORDER BY nombre_tipo ASC";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos=$query->fetchall();
    return $this->objetos;
}
}
?>