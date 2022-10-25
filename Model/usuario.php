<?php
include_once 'conexion.php';

class Usuario{
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
        usuario
        INNER JOIN
        tipo
        ON 
        id_tipo=id WHERE estado='A' AND nombre LIKE :consulta";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':consulta'=>"%$consulta%"));
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }else {
 
        $sql="SELECT * FROM
        usuario
        INNER JOIN
        tipo
        ON 
        id_tipo =id WHERE estado='A' AND nombre NOT LIKE '' ORDER BY id_usuario LIMIT 25";
        $query=$this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchall();
        return $this->objetos;
    
    }
}

 function logo($user,$pass){
     $sql ="SELECT * FROM usuario 
     INNER JOIN
         tipo 
           ON 
          id_tipo =id WHERE usuario=:usuario AND clave=:pass";
     $query = $this->acceso->prepare($sql);
     $query->execute(array(':usuario'=>$user,':pass'=>$pass));
     $this->objetos=$query->fetchall();
    return $this->objetos;   
 }
 
 function obtener_datos_logueo($user){
    $sql ="SELECT * FROM usuario u
                    INNER JOIN tipo t on u.id_tipo=t.id and u.usuario = :usuario";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':usuario'=>$user));
    $this->objetos=$query->fetchall();
    return $this->objetos;
}


function crear($nombre,$correo,$user,$clave,$id_tipo) {
    $sql="SELECT id_usuario FROM usuario WHERE usuario=:usuario";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':usuario'=>$user));
    $this->objetos=$query->fetchall();

    if (!empty($this->objetos)) {
        
        echo'error';
    }else {
        $sql="INSERT INTO usuario(nombre,correo,usuario,clave,id_tipo) VALUES(:nombre,:correo,:usuario,:clave,:id_tipo)";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre,':correo'=>$correo,':usuario'=>$user,':clave'=>$clave,':id_tipo'=>$id_tipo));
        echo'agregado';
    }
}

  function borrar($id_usuario){
    $sql="SELECT id_usuario FROM usuario WHERE id_usuario=:id_usuario";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':id_usuario'=>$id_usuario));
    $this->objetos=$query->fetchall();

    if (!empty($this->objetos)){
        $sql="UPDATE usuario SET estado='I' WHERE id_usuario=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario));
            echo 'borrado';
    }
    else{
         echo 'noborrado';
     }
 }

//funcion para editar usuario
function edit($id,$nombre,$correo,$id_tipo){
    $sql="SELECT id_usuario FROM usuario WHERE id_usuario!=:id AND nombre=:nombre AND correo=:correo AND id_tipo=:id_tipo";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id,':nombre'=>$nombre,':correo'=>$correo,':id_tipo'=>$id_tipo));
    $this->objetos=$query->fetchall();

    if (!empty($this->objetos)) {
        echo 'noedit';
    }else{
    $sql="UPDATE usuario SET nombre=:nombre, correo=:correo, id_tipo=:id_tipo WHERE id_usuario=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id,':nombre'=>$nombre,':correo'=>$correo,':id_tipo'=>$id_tipo));
    echo 'edito';
    }
}



 
// //funcion para cambiar contraseña
// function cambiar_contra($id_usuario,$oldpass,$newpass){
//     $sql="SELECT * FROM usuario WHERE id_usuario=:id and contrasena_us=:oldpass";
//     $query = $this->acceso->prepare($sql);
//     $query->execute(array(':id'=>$id_usuario,':oldpass'=>$oldpass));
//     $this->objetos=$query->fetchall();
//     if (!empty($this->objetos)) {
        
//         $sql="UPDATE usuario SET contrasena_us=:newpass WHERE id_usuario=:id";
//         $query=$this->acceso->prepare($sql);
//         $query->execute(array(':id'=>$id_usuario,':newpass'=>$newpass));
//         echo 'Actualizado';
//     }else {
//             echo 'No Actualizado';  
//     }
//  }

// //funcion para cambiar contraseña encriptada
// //  function cambiar_contra($id_usuario,$oldpass,$newpass){
// //     $sql="SELECT * FROM usuario WHERE id_usuario=:id";
// //     $query = $this->acceso->prepare($sql);
// //     $query->execute(array(':id'=>$id_usuario));
// //     $this->objetos=$query->fetchall();

// //     foreach ($this->objetos as $objeto) {
// //         $contrasena_actual= $objeto->contrasena_us;
// //     }

// //     if (strpos($contrasena_actual,'$2y$10$')=== 0) {
// //         if (password_verify($oldpass,$contrasena_actual)) {

// //             $pass = password_hash($newpass,PASSWORD_BCRYPT,['cost'=>10]);

// //             $sql="UPDATE usuario SET contrasena_us=:newpass WHERE id_usuario=:id";
// //             $query=$this->acceso->prepare($sql);
// //             $query->execute(array(':id'=>$id_usuario,':newpass'=>$pass));
// //             echo 'Actualizado';
// //         }else{
// //             echo 'No Actualizado';
// //         }
// //     }else{

// //         if ($oldpass==$contrasena_actual) {
// //             $pass = password_hash($newpass,PASSWORD_BCRYPT,['cost'=>10]);
// //             $sql="UPDATE usuario SET contrasena_us=:newpass WHERE id_usuario=:id";
// //             $query=$this->acceso->prepare($sql);
// //             $query->execute(array(':id'=>$id_usuario,':newpass'=>$pass));
// //             echo 'Actualizado';
// //         }else{
// //             echo 'No Actualizado';
// //         }
// //     }
// //  }





// //funcion para cambiar foto
// function cambiar_foto($id_usuario,$nombre){
//     $sql="SELECT avatar FROM usuario WHERE id_usuario=:id";
//     $query = $this->acceso->prepare($sql);
//     $query->execute(array(':id'=>$id_usuario));
//     $this->objetos=$query->fetchall();

//         $sql="UPDATE usuario SET avatar=:nombre WHERE id_usuario=:id";
//         $query=$this->acceso->prepare($sql);
//         $query->execute(array(':id'=>$id_usuario,':nombre'=>$nombre));
        
//     return $this->objetos;

//  }

//  //funcion para buscar usuario por medio del buscar 


// function crear($nombre,$apellido,$edad,$dni,$pass,$tipo,$avatar){

//     $sql="SELECT id_usuario FROM usuario WHERE dni_us=:dni";
//     $query=$this->acceso->prepare($sql);
//     $query->execute(array(':dni'=>$dni));
//     $this->objetos=$query->fetchall();

//     if (!empty($this->objetos)) {
        
//         echo'error';
//     }else {
//         $sql="INSERT INTO usuario(nombre_us,apellidos_us,edad,dni_us,contrasena_us,us_tipo,avatar) 
//             VALUES(:nombre,:apellido,:edad,:dni,:pass,:tipo,:avatar)";
//         $query=$this->acceso->prepare($sql);
//         $query->execute(array(':nombre'=>$nombre,':apellido'=>$apellido,':edad'=>$edad,':dni'=>$dni,':pass'=>$pass,':tipo'=>$tipo,':avatar'=>$avatar));
//         echo'agregado';
//     }
// }
   
//   function ascender($pass,$id_ascendido,$id_usuario){
//     $sql="SELECT id_usuario FROM usuario WHERE id_usuario=:id_usuario and contrasena_us=:pass";
//     $query=$this->acceso->prepare($sql);
//     $query->execute(array(':id_usuario'=>$id_usuario,':pass'=>$pass));
//     $this->objetos=$query->fetchall();
    
//     if (!empty($this->objetos)){
//             $tipo=1;
//             $sql="UPDATE usuario SET us_tipo=:tipo WHERE id_usuario=:id";
//             $query = $this->acceso->prepare($sql);
//             $query->execute(array(':id'=>$id_ascendido,':tipo'=>$tipo));
//             echo 'ascendido';
//         }
//         else{
//             echo 'noasendido';
//      }
   
// }


//   function descender($pass,$id_descendido,$id_usuario){
//     $sql="SELECT id_usuario FROM usuario WHERE id_usuario=:id_usuario AND contrasena_us=:pass";
//     $query=$this->acceso->prepare($sql);
//     $query->execute(array(':id_usuario'=>$id_usuario,':pass'=>$pass));
//     $this->objetos=$query->fetchall();

//     if (!empty($this->objetos)) {
//     $tipo=2;
//     $sql="UPDATE usuario SET us_tipo=:tipo WHERE id_usuario=:id";
//     $query=$this->acceso->prepare($sql);
//     $query->execute(array(':id'=>$id_descendido,':tipo'=>$tipo));
//         echo 'descendido';
//     }else {
//         echo 'nodescendido';
//     }
//  }


//   function borrar($pass,$id_borrado,$id_usuario){
//     $sql="SELECT id_usuario FROM usuario WHERE id_usuario=:id_usuario AND contrasena_us=:pass";
//     $query=$this->acceso->prepare($sql);
//     $query->execute(array(':id_usuario'=>$id_usuario,':pass'=>$pass));
//     $this->objetos=$query->fetchall();

//     if (!empty($this->objetos)){
//         $sql="DELETE FROM usuario WHERE id_usuario=:id";
//         $query = $this->acceso->prepare($sql);
//         $query->execute(array(':id'=>$id_borrado));
//             echo 'borrado';
//     }
//     else{
//          echo 'noborrado';
//      }
//  }



//     function devolver_avatar($id_usuario){
//         $sql ="SELECT avatar FROM usuario WHERE id_usuario=:id_usuario";
//         $query = $this->acceso->prepare($sql);
//         $query->execute(array(':id_usuario'=>$id_usuario));
//         $this->objetos=$query->fetchall();
//         return $this->objetos;
//     }



// //funcion para buscar correo y contraseña esten registrados.
//     function verificar($email,$dni){
//         $sql ="SELECT * FROM usuario WHERE correo_us=:email and dni_us=:dni";
//         $query = $this->acceso->prepare($sql);
//         $query->execute(array(':email'=>$email, ':dni'=>$dni));
//         $this->objetos=$query->fetchall();

//         if (!empty($this->objetos)){
//           if ($query->rowCount()==1) {
//             echo 'encontrado';
//           }else{
//             echo 'noencontrado';
//           }
//         }
//         else{
//             echo 'noencontrado';
//         }
//     }



//     function reemplazar($codigo,$email,$dni){
//         $sql="UPDATE usuario SET contrasena_us=:codigo WHERE correo_us=:email and dni_us=:dni";
//     $query=$this->acceso->prepare($sql);
//     $query->execute(array(':codigo'=>$codigo,':email'=>$email,':dni'=>$dni));
//     // echo 'reemplazado';

//     }

}
?>