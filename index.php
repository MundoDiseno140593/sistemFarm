<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <link rel="stylesheet" href=/systemf/css/font-awesome.min.css">
    <link rel="stylesheet" href="/systemf/css/estilo.css">
    <link rel="stylesheet" type="text/css" href="/systemf/css/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="/systemf/css/toastr.min.css">
    <title>Login | Sistema De facturacion</title>
</head>
<?php
session_start();
if (!empty($_SESSION['id_tipo'])) {
    header('location: Controller/loginController.php');
}
else { 
    session_destroy();
?>
<body>
    <img class="wave" src="../img/wave.svg" alt="">
    <div class="contenedor">
        <div class="img">
            <img src="img/fondo.svg" alt="">
        </div>
        <div class="contenido-login">
        <form action="Controller/loginController.php" method="POST">
            <img src="img/logo.png" alt="logo">
            <h2 class="animate__animated animate__jackInTheBox">Sistema Facturacion</h2>

            <div class="input-div dni">
                <div class="i">
                    <i class="fas fa-user"></i>
                </div>
                <div class="div">
                     <h5>Usuario:</h5>
                    <input type="text" name="user" class="input" required>
                </div>
            </div>

            <div class="input-div pass">
                <div class="i">
                <i class="fas fa-lock"></i>
                </div>
                <div class="div">
                <h5>Contraseña:</h5>
            <input type="password" name="pass" class="input" required>
                </div>
            </div>
                <a href="#">Recuperar Contraseña</a>
                <a href="">Create Warpice</a>
            <input type="submit" class="btn" value="Iniciar Sesion">
            </div>
        </form>
        </div>
    </div>
</body>
<script src="js/login.js">
    
</script>
</html>
<?php } ?>