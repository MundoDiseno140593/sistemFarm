<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/systemf/View/layouts/header.php';
?>

<title>Facturacion | Producto</title>

<!-- Modal de crear producto-->
<div class="animate__animated animate__bounceInDown modal fade" id="boton_crear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Crear Producto</h3>
          <button data-dismiss="modal" aria-label="close" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <div class="alert alert-danger text-center" id="err" style="display: none;">
            <span><i class="fas fa-times m-1"> El Producto Ya Existe</i></span>
          </div>
          <div class="alert alert-success text-center" id="edit_prod" style="display: none;">
                 <span><i class="fas fa-check m-1"> Se Edito Correctamente</i></span>
               </div>
               <div class="alert alert-danger text-center" id="noedit" style="display: none;">
                  <span><i class="fas fa-times m-1"> El Producto Ya Existe</i></span>
              </div>
          <div class="alert alert-success text-center" id="agrega" style="display: none;">
            <span><i class="fas fa-check m-1"> Se Registro Con Exito El Producto</i></span>
          </div>
          <form id="form_crear_prod">
          <div class="form-group">
              <label for="proveedor">Proveedor:</label>
              <select name="proveedor" id="proveedor" class="form-control  option" style="width: 100%;"></select>
            </div>
            <div class="form-group">
              <label for="producto_nombre">Producto</label>:</label>
              <input id="producto_nombre" type="text" class="form-control" placeholder="Ingrese Producto" required>
            </div>
            <div class="form-group">
              <label for="precio">Precio</label>:</label>
              <input id="precio" type="text" class="form-control" placeholder="Ingrese Precio.." required>
            </div>
            <input type="hidden" id="id_producto_edit">
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-outline-success btn-circle btn-lg float-right m-1"><i class="fas fa-check"></i></button>
          <button type="button" class="btn btn-outline-secondary btn-circle btn-lg float-right m-1" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i></button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- modal para reportes tanto en Excel como en PDF -->
<div class="animate__animated animate__bounceInDown modal fade" id="modalformatoreporte" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Elegir Formato De Reporte</h3>
          <button data-dismiss="modal" aria-label="close" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <div class="form-group text-center">
            <button id="boton_reporte" class="btn btn-outline-danger">Formato PDF <i class="far fa-file-pdf ml-2"></i></button>
            <button id="boton_reporteExcel" class="btn btn-outline-success">Formato Excel <i class="far fa-file-excel"></i></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- modal para cambiar de imagen -->
<div class="animate__animated animate__bounceInDown modal fade" id="cambiologo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header  text-center">
        <h5 class="modal-title" id="cambiocontra">Cambiar Foto De Producto</h5>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <img id='logoactual' src="../img/producto/" class="profile-user-img img-fluid img-circle">
        </div>
        <div class="text-center">
          <b id="nombre_logo">
          </b>
        </div>

        <div class="alert alert-success text-center" id="edit" style="display: none;">
          <span><i class="fas fa-check m-1"> Se Cambio Correctamente El Logo Del producto</i></span>
        </div>
        <div class="alert alert-danger text-center" id="noedit" style="display: none;">
          <span><i class="fas fa-times m-1"> Formato De Foto Incorrecto</i></span>
        </div>
        <form id="form-logo" name="form-logo" enctype="multipart/form-data">
          <div class="input-group mb-3 ml-5 mt-2">
            <input type="file" name="photo" class="input-group">
            <input type="hidden" name="funcion" id="funcion">
            <input type="hidden" name="id-logo-prod" id="id-logo-prod">

          </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary btn-circle btn-lg" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i></button>
        <button type="submit" class="btn btn-outline-primary btn-circle btn-lg"><i class="fas fa-check"></i></button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- para agregar stock al producto-->
<div class="animate__animated animate__bounceInDown modal fade" id="ingresar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header  text-center">
        <h5 class="modal-title">Agregar Producto</h5>
      </div>
      <div class="modal-body">
        <div class="">
          <div class="alert alert-success text-center" id="agrego" style="display: none;">
            <span><i class="fas fa-check m-1">Se agrego El Stock Correctamente</i></span>
          </div>
          <div class="alert alert-danger text-center" id="noag" style="display: none;">
            <span><i class="fas fa-times m-1"> Hubo Error Al Ingresar Los Datos</i></span>
          </div>
          <form id="form_crear_entrada">
            <div class="form-group text-center">
              <label for="nombre_producto">Producto:</label>
              <label id="nombre_producto">Nombre Producto</label>
            </div>
            <div class="dropdown-divider"></div>
            <div class="form-group">

              <label for="cantidad_lot">Cantidad:</label>
              <input id="cantidad_lot" type="text" class="form-control" placeholder="Ingrese Cantidad Del Produco" required>
            </div>
            <div class="form-group">
              <label for="precio_lot">Cantidad:</label>
              <input id="precio_lot" type="text" class="form-control" placeholder="Ingrese Precio Del Producto" required>
            </div>
            <input type="hidden" id="id_producto_entrada">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary btn-circle btn-lg" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i></button>
          <button type="submit" class="btn btn-outline-success btn-circle btn-lg"><i class="fas fa-check"></i></button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Producto <button type="button" id="btn_crear" data-toggle="modal" data-target="#boton_crear" class="btn bg-gradient-primary ml-2">
              Crear Producto
            </button>
            <button type="button" id="reporte" data-toggle="modal" data-target="#modalformatoreporte" class="animate__animated animate__shakeY btn bg-gradient-success ml-2">
              Reporte De Producto
            </button>
          </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
            <li class="breadcrumb-item active">Gestion Producto</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section>
    <div class="container-fluid">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Buscar Producto</h3>
          <div class="input-group">
            <input id="buscar" type="text" class="form-control float-left" placeholder="Ingrese Nombre Del Producto">
            <div class="input-group-append">
              <button class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div id="productos" class="row d-flex align-items-stretch">

          </div>
        </div>
        <div class="card-footer">

        </div>
      </div>
    </div>
  </section>
</div>
<!-- /.content-wrapper -->






<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/systemf/View/layouts/footer.php';
?>


<script src="/systemf/View/producto.js"></script>