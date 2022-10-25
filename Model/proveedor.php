<?php
include_once 'conexion.php';

class Proveedor{
 var $objetos;

 public function __construct()
 {
     $db = new Conexion();
     $this->acceso = $db->pdo;
 }
 
 function buscar(){
    if (!empty($_POST['consulta'])) {
        $consulta=$_POST['consulta'];

        $sql="SELECT * FROM
        proveedor
        WHERE estado = 'A' AND marca LIKE :consulta";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':consulta'=>"%$consulta%"));
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }else {

        $sql="SELECT * FROM
        proveedor
        WHERE estado = 'A' AND marca NOT LIKE '' ORDER BY id_proveedor LIMIT 25";
        $query=$this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchall();
        return $this->objetos;
    
    }
}

 
function crear($proveedor1,$contacto,$apellido,$telefono,$direccion,$id_usuario) {
    $sql="SELECT id_proveedor FROM proveedor WHERE marca=:proveedor";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':proveedor'=>$proveedor1));
    $this->objetos=$query->fetchall();

    if (!empty($this->objetos)) {
        
        echo'error';
    }else {
        $sql="INSERT INTO proveedor(marca,nombres,apellidos,telefono,direccion,usuario_id) VALUES(:marca,:nombres,:apellidos,:telefono,:direccion,:usuario_id)";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':marca'=>$proveedor1,':nombres'=>$contacto,':apellidos'=>$apellido,':telefono'=>$telefono,':direccion'=>$direccion,':usuario_id'=>$id_usuario));
        echo'agregado';
    }
}

  function borrar($id_proveedor) {
    $sql="SELECT id_proveedor FROM proveedor WHERE id_proveedor=:codproveedor";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':codproveedor'=>$id_proveedor));
    $this->objetos=$query->fetchall();

    if (!empty($this->objetos)){
        $sql="UPDATE proveedor SET estado = 'I' WHERE id_proveedor=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_proveedor));
            echo 'borrado';
    }
    else{
         echo 'noborrado';
     }
 } 

// funcion para editar cliente
function edit($id,$proveedor1,$contacto,$apellido,$telefono,$direccion){
    $sql="SELECT id_proveedor FROM proveedor WHERE id_proveedor!=:id AND marca=:marca AND  nombres=:nombres  AND apellidos=:apellidos AND direccion=:direccion AND telefono=:telefono";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,':marca'=>$proveedor1,':nombres'=>$contacto,':apellidos'=>$apellido,':direccion'=>$direccion,':telefono'=>$telefono));
        $this->objetos=$query->fetchall();
    
        if (!empty($this->objetos)) {
            echo 'noedit';
        }else{

    $sql="UPDATE proveedor SET marca=:marca, nombres=:nombres,apellidos=:apellidos, telefono=:telefono, direccion=:direccion WHERE id_proveedor=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id,':marca'=>$proveedor1,':nombres'=>$contacto,':apellidos'=>$apellido,':telefono'=>$telefono,':direccion'=>$direccion));
    echo 'edito';
    }
}


function rellenar_proveedores(){
    $sql="SELECT * FROM proveedor WHERE estado='A' ORDER BY marca ASC";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos=$query->fetchall();
    return $this->objetos;
}

}
?>