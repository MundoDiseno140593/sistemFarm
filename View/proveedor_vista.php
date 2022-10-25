<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/systemf/View/layouts/header.php';
?>

<title>Facturacion | Proveedor</title>
 
<!-- Modal de crear proveedor-->
<div class="animate__animated animate__bounceInDown modal fade" id="boton_crear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Craer Proveedor</h3>
          <button data-dismiss="modal" aria-label="close" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <div class="alert alert-danger text-center" id="error" style="display: none;">
            <span><i class="fas fa-times m-1"> El Proveedor Ya Existe</i></span>
          </div>
          <div class="alert alert-success text-center" id="agregado" style="display: none;">
            <span><i class="fas fa-check m-1"> Se Registro Con Exito El Proveedor</i></span>
          </div>
          <form id="form_crear">
          <div class="form-group">
              <label for="proveedor">Proveedor</label>:</label>
              <input id="proveedor" type="text" class="form-control" placeholder="Ingrese Proveedor" required>
            </div>
            <div class="form-group">
              <label for="contacto">Contacto</label>:</label>
              <input id="contacto" type="text" class="form-control" placeholder="Ingrese Nombre Completo Del Contacto.." required>
            </div>
            <div class="form-group">
              <label for="apellido">Apellido</label>:</label>
              <input id="apellido" type="text" class="form-control" placeholder="Ingrese Apellido Completo Del Contacto.." required>
            </div>
            <div class="form-group">
              <label for="telefono">Telefono:</label>
              <input id="telefono" type="text" class="form-control" placeholder="Ingrese Telefono" required>
            </div>
            <div class="form-group">
              <label for="direccion">Direccion</label>:</label>
              <textarea class="form-control" id="direccion" rows="3"></textarea>
            </div>
            <input type="hidden" id="id_edit_proveedor">
        </div>
        <div class="card-footer">
          <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
          <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cerrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal de modificar  cliente-->
<div class="animate__animated animate__bounceInDown modal fade" id="editar_cliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Editar Proveedor</h3>
          <button data-dismiss="modal" aria-label="close" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <div class="alert alert-success text-center" id="editar__proveedor" style="display: none;">
            <span><i class="fas fa-check m-1"> Se Actualizo Con Exito</i></span>
          </div>
          <div class="alert alert-danger text-center" id="no_editar-proveedor" style="display: none;">
            <span><i class="fas fa-times m-1"> Nos Se Puede Actualizar</i></span>
          </div>
          <form id="form_editar">
          <div class="form-group">
              <label for="proveedor_edit">Proveedor</label>:</label>
              <input id="proveedor_edit" type="text" class="form-control" placeholder="Ingrese Proveedor">
            </div>
            <div class="form-group">
              <label for="contacto_edit">Contacto:</label>
              <input id="contacto_edit" type="text" class="form-control" placeholder="Ingrese Nombre Completo Contacto">
            </div>
            <div class="form-group">
              <label for="apellido_ed">Apellido:</label>
              <input id="apellido_ed" type="text" class="form-control" placeholder="Ingrese Apellido Completo Contacto">
            </div>
            <div class="form-group">
              <label for="telefono_edit">Telefono:</label>
              <input id="telefono_edit" type="text" class="form-control" placeholder="Ingrese Telefono">
            </div>

            <div class="form-group">
              <label for="direccion_edit">Direccion</label>:</label>
              <textarea class="form-control" id="direccion_edit" rows="3"></textarea>
            </div>

            <input type="hidden" id="codproveedor">
        </div>
        <div class="card-footer">
          <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
          <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cerrar</button>
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

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Proveedor <button type="button" id="btn_crear" data-toggle="modal" data-target="#boton_crear" class="btn bg-gradient-primary ml-2">
              Crear proveedor
            </button>
            <button type="button" id="reporte" data-toggle="modal" data-target="#modalformatoreporte" class="animate__animated animate__shakeY btn bg-gradient-success ml-2">
              Reporte De Proveedor
            </button>
          </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
            <li class="breadcrumb-item active">Gestion Proveedor</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section>
    <div class="container-fluid">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Buscar Proveedor</h3>
          <div class="input-group">
            <input id="buscar" type="text" class="form-control float-left" placeholder="Ingrese Nombre Del Proveedor">
            <div class="input-group-append">
              <button class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div id="proveedores" class="row d-flex align-items-stretch">
 
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


<script src="/systemf/View/proveedor.js"></script>