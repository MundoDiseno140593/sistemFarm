<?php
include_once 'conexion.php';

class Cliente{
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
        cliente
         WHERE estado='A' AND nombres LIKE :consulta";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':consulta'=>"%$consulta%"));
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }else {

        $sql="SELECT * FROM
        cliente
        WHERE estado='A' AND nombres NOT LIKE '' ORDER BY id_cliente LIMIT 25";
        $query=$this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchall();
        return $this->objetos;
    
    }
}

 
function crear($nit,$nombre,$apellido,$telefono,$direccion,$id_usuario) {
    $sql="SELECT id_cliente,estado FROM cliente WHERE  nombres=:nombres";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':nombres'=>$nombre));
    $this->objetos=$query->fetchall();

    if (!empty($this->objetos)) {
        foreach ($this->objetos as $client) {
            $client_id=$client->id_cliente;
            $client_estado=$client->estado;
        }
        if ($client_estado=='A') {
            echo 'noadd';
        }else {
            $sql="UPDATE cliente SET estado='A' WHERE id_cliente=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$client_id));
            echo 'add';
        }
    }else {
        $sql="INSERT INTO cliente(codigo,nombres,apellidos,telefono,direccion,usuario_id) VALUES(:codigo,:nombres,:apellidos,:telefono,:direccion,:usuario_id)";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':codigo'=>$nit,':nombres'=>$nombre,':apellidos'=>$apellido,':telefono'=>$telefono,':direccion'=>$direccion,':usuario_id'=>$id_usuario));
        echo'agregado';
    }
}

  function borrar($id_cliente){
    $sql="SELECT id_cliente FROM cliente WHERE id_cliente=:idcliente";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':idcliente'=>$id_cliente));
    $this->objetos=$query->fetchall();

    if (!empty($this->objetos)){
        $sql="UPDATE cliente SET estado='I' WHERE id_cliente=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_cliente));
            echo 'borrado';
    }
    else{
         echo 'noborrado';
     }
 }


//funcion para editar cliente
function edit($id,$nombre,$apellido,$telefono,$direccion){
    $sql="SELECT id_cliente FROM cliente WHERE id_cliente=:id";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    $this->objetos=$query->fetchall();

    if (empty($this->objetos)) {
        echo 'noedito';

    }else{
    $sql="UPDATE cliente SET nombres=:nombre,apellidos=:apellido, telefono=:telefono, direccion=:direccion WHERE id_cliente=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id,':nombre'=>$nombre,':apellido'=>$apellido,':telefono'=>$telefono,':direccion'=>$direccion));
    echo 'edito';
   }
}

}
?>