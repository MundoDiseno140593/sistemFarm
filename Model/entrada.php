<?php 
include_once 'conexion.php';

class Entrada{
    var $objetos;

    public function __construct()
    { $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function crear_lote($id_producto,$cantidad,$precio,$id_usuario){
       $sql="INSERT INTO lote(id_producto,cantidad,precio,usuario_id) VALUES (:id_producto,:cantidad,:precio,:usuario_id)";
       $query=$this->acceso->prepare($sql);
      $query->execute(array(':id_producto'=> $id_producto ,':cantidad'=>$cantidad,':precio'=>$precio,':usuario_id'=>$id_usuario));
       $this->objetos=$query->fetchall();
       echo 'add';
    }
}
?>