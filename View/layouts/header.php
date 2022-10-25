<!DOCTYPE html>
<html lang="en" style="height: auto;" class="">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="/sistema1/img/farmacia.png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/systemf/css/css/all.min.css">
  <Link rel="stylesheet" href="/systemf/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/systemf/css/adminlte.min.css">
  <link rel="stylesheet" type="text/css" href="/systemf/css/sweetalert2.min.css">
  <link rel="stylesheet" type="text/css" href="/systemf/css/toastr.min.css">
  <link rel="stylesheet" type="text/css" href="/systemf/css/datatables.min.css">
  <!-- <link rel="stylesheet" type="text/css" href="/sistema1/css/pnotify.buttons.css">
  <link rel="stylesheet" type="text/css" href="/sistema1/css/pnotify.css">
  <link rel="stylesheet" type="text/css" href="/sistema1/css/custom.min.css"> -->
  <Link rel="stylesheet" href="/systemf/css/animate.min.css">

  <style type="text/css"></style>
  <?php include_once "funcion.php"; ?>
</head>

<style>
    .btn-circle {
  width: 30px;
  height: 30px;
  text-align: center;
  padding: 6px 0;
  font-size: 12px;
  line-height: 1.428571429;
  border-radius: 15px;
}
.btn-circle.btn-lg {
  width: 50px;
  height: 50px;
  padding: 10px 16px;
  font-size: 18px;
  line-height: 1.33;
  border-radius: 25px;
}
.btn-circle.btn-xl {
  width: 70px;
  height: 70px;
  padding: 10px 16px;
  font-size: 24px;
  line-height: 1.33;
  border-radius: 35px;
}

</style>

<body class="sidebar-mini dark-mode layout-navbar-fixed layout-fixed layout-footer-fixed accent-info" style="height: auto;">

<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-light bg-dark">
        <!-- Left navbar links -->
        <ul class="navbar-nav text-center">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="../../index3.html" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
            </li>

        </ul>
        <ul>
            <i class="far fa-clock nav-item d-none d-sm-inline-block">
                <b>Nicaragua, <?php echo fechaC(); ?></b>
            </i>
        </ul>


        <ul class="navbar-nav ml-auto">
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas  fa-lg fa-sign-out-alt"></i>
                    <img src="/facturacion/img/avatar4.png" class="img-fluid img-circle" width="35" height="35" alt="logo">
                    <span class="badge badge-warning navbar-badge"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header active bg-success">Opciones</span>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item">


                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item">
                        <i class="fas fa-user-tie"></i>
                        <b class="text-mutedv mr-5"> configuracion</b>
                    </a>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item">
                        <i class="fas fa-user-tie"></i>
                        <span class="text-muted mr-5"> configuracion</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <b id="usuario_nav" class="dropdown-item dropdown-footer accent-blue"></b>
                    <a href="/systemf/Controller/logout.php" class="dropdown-item dropdown-footer">Cerrar Sesion</a>
                </div>
            </li>
        </ul>
    </nav>
    <aside class="main-sidebar elevation-4 sidebar-dark-primary">
        <!-- Brand Logo -->
        <a href="#" class="brand-link bg-dark bg-danger bg-gray-dark">
            <img src="logo" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Sistema Facturacion</span>
        </a>
        <div class="sidebar os-theme-light" style="overflow-y: auto;">

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="" class="img-circle elevation-2" alt="Usuario">
                </div>
                <div class="info">
                    <a href="#" class="d-block">usuario</a>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column active" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-header">Usuario</li>
                    <li class="nav-item">
                        <a href="../View/usuario_vista.php" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                usuarios
                                <span class="badge badge-info right">2</span>
                            </p>
                        </a>
                    </li>
                    <div class="dropdown-divider"></div>
                    <li class="nav-header">Cliente</li>
                    <li class="nav-item">
                        <a href="../View/cliente_vista.php" class="nav-link">
                            <i class="nav-icon fas fa-user-tie"></i>
                            <p>
                                Clientes
                                <span class="badge badge-info right">2</span>
                            </p>
                        </a>
                    </li>
                    <div class="dropdown-divider"></div>
                    <li class="nav-header">Proveedor</li>
                    <li class="nav-item">
                        <a href="../View/proveedor_vista.php" class="nav-link">
                            <i class="nav-icon fas fa-parachute-box"></i>
                            <p>
                                Proveedores
                                <span class="badge badge-info right">2</span>
                            </p>
                        </a>
                    </li>

                    <div class="dropdown-divider"></div>
                    <li class="nav-header">Produto</li>
                    <li class="nav-item">
                        <a href="../View/producto_vista.php" class="nav-link">
                            <i class="nav-icon fab fa-product-hunt"></i>
                            <p>
                                Productos
                                <span class="badge badge-info right">2</span>
                            </p>
                        </a>
                    </li>

                    <div class="dropdown-divider"></div>
                    <li class="nav-header">Ventas</li>
                    <li class="nav-item">
                        <a href="../View/producto_vista.php" class="nav-link">
                            <i class="nav-icon fab fa-product-hunt"></i>
                            <p>
                                Ventas
                                <span class="badge badge-info right">2</span>
                            </p>
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
    </aside>