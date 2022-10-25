<?php 
include_once 'conexion.php';

class Producto{
    var $objetos;

    public function __construct()
    { $db = new Conexion();
        $this->acceso = $db->pdo;
    }


function buscar(){

        if (!empty($_POST['consulta'])) {
    
            $consulta=$_POST['consulta'];
    
             $sql="SELECT
            producto.id_producto, 
	        producto.nombre, 
	        producto.precio, 
	        producto.avatar, 
	        producto.estado, 
            proveedor.marca
         FROM
             producto
             INNER JOIN
             proveedor
             ON 
                 producto.id_proveedor = proveedor.id_proveedor  WHERE producto.estado='A' AND producto.nombre  LIKE :consulta LIMIT 25";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }else {
            $sql="SELECT
            producto.id_producto, 
	        producto.nombre, 
	        producto.precio, 
	        producto.avatar, 
	        producto.estado, 
            proveedor.marca
        FROM
            producto
            INNER JOIN
            proveedor
            ON 
            producto.id_proveedor = proveedor.id_proveedor WHERE producto.estado='A' AND producto.nombre  NOT LIKE '' ORDER BY producto.nombre LIMIT 25";
            $query=$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;
        
        }
}


function crear($proveedor,$producto_nombre,$precio,$avatar){
    $sql="SELECT id_producto,estado FROM producto WHERE nombre=:nombre AND id_proveedor=:id_proveedor";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':nombre'=>$producto_nombre,':id_proveedor'=>$proveedor));
    $this->objetos=$query->fetchall();
     
    if (!empty($this->objetos)) {
        foreach ($this->objetos as $prod) {
            $prod_id_producto=$prod->id_producto;
            $prod_estado=$prod->estado;
        }
            if ($prod_estado=='A') {
            echo 'no_add';

        }else {
            $sql="UPDATE producto SET estado='A' WHERE id_producto=:id";
            $query=$this->acceso->prepare($sql);
                $query->execute(array(':id'=>$prod_id_producto));
            echo 'add';
        }
    }
    else{

        $sql="INSERT INTO producto(nombre,id_proveedor,precio,avatar) VALUES (:nombre,:id_proveedor,:precio,:avatar)";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$producto_nombre,':id_proveedor'=>$proveedor,':precio'=>$precio,':avatar'=>$avatar));
        echo 'add';
    }
}

  
function editar($id,$id_proveedor,$producto_nombre,$precio,$avatar){
    $sql="SELECT id_producto FROM producto WHERE id_producto!=:id AND nombre=:nombre AND id_proveedor=:proveedor";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id,':nombre'=>$producto_nombre,':proveedor'=>$id_proveedor));
    $this->objetos=$query->fetchall();

    if (!empty($this->objetos)) {
        echo 'noedit';
    }else{

        $sql="UPDATE producto SET nombre=:nombre,id_proveedor=:proveedor,precio=:precio WHERE id_producto=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,':nombre'=>$producto_nombre,':proveedor'=>$id_proveedor,':precio'=>$precio));

        echo 'edit';
    }
}

function borrar($id){
    $sql="SELECT id_producto FROM producto WHERE id_producto=:id_producto";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':id_producto'=>$id));
    $this->objetos=$query->fetchall();

    if (!empty($this->objetos)){
        $sql="UPDATE producto SET estado = 'I'  WHERE id_producto=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
            echo 'borrado';
    }
    else{
         echo 'noborrado';
     }
}

function cambiar_logo($id,$nombre){
        $sql="SELECT avatar FROM producto WHERE id_producto=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos=$query->fetchall();
    
            $sql="UPDATE producto SET avatar=:nombre WHERE id_producto=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id,':nombre'=>$nombre));
            
        return $this->objetos;
    
}

function obtener_stock($id){
 $sql="SELECT SUM(cantidad) as total  FROM lote WHERE id_producto=:id";
 $query=$this->acceso->prepare($sql);
 $query->execute(array(':id'=>$id));
 $this->objetos=$query->fetchall();
 return $this->objetos;
} 

function obtener_stock1($id){
    $sql="SELECT SUM(precio) as prec  FROM lote WHERE id_producto=:id";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    $this->objetos=$query->fetchall();
    return $this->objetos;
   } 
    
 
    // function buscar_id($id){

    //     $sql="SELECT id_productos,productos.nombre as nombre,concentracion,adicional,precio,laboratorio.nombre as laboratorio, tipo_producto.nombre as tipo, presentacion.nombre as presentacion,productos.avatar as avatar,prod_lab,prod_tip,prod_pre
    //     FROM productos 
    //     JOIN laboratorio ON prod_lab=id_laboratorio 
    //     JOIN tipo_producto ON prod_tip=id_tip_prod 
    //     JOIN presentacion ON prod_pre=id_presentacion WHERE id_productos=:id";
    //     $query=$this->acceso->prepare($sql);
    //     $query->execute(array(':id'=>$id));
    //     $this->objetos=$query->fetchall();
    //     return $this->objetos;
    // }

    // function reporte_producto(){
    //         $sql="SELECT id_productos,productos.nombre as nombre,concentracion,adicional,precio,laboratorio.nombre as laboratorio, tipo_producto.nombre as tipo, presentacion.nombre as presentacion,productos.avatar as avatar,prod_lab,prod_tip,prod_pre
    //         FROM productos 
    //         JOIN laboratorio ON prod_lab=id_laboratorio 
    //         JOIN tipo_producto ON prod_tip=id_tip_prod 
    //         JOIN presentacion ON prod_pre=id_presentacion AND productos.nombre NOT LIKE '' ORDER BY productos.nombre";
    //         $query=$this->acceso->prepare($sql);
    //         $query->execute();
    //         $this->objetos=$query->fetchall();
    //         return $this->objetos;
    // }

    // function rellenar_productos(){
    //     $sql="SELECT id_productos,productos.nombre as nombre,concentracion,adicional,precio,laboratorio.nombre as laboratorio, tipo_producto.nombre as tipo, presentacion.nombre as presentacion
    //         FROM productos 
    //         JOIN laboratorio ON prod_lab=id_laboratorio AND productos.estado='A'
    //         JOIN tipo_producto ON prod_tip=id_tip_prod 
    //         JOIN presentacion ON prod_pre=id_presentacion
    //         ORDER BY nombre ASC";
    //     $query = $this->acceso->prepare($sql);
    //     $query->execute();
    //     $this->objetos=$query->fetchall();
    //     return $this->objetos;
    // }

}
?>