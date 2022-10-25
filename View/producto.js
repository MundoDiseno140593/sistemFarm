$(document).ready(function() {

    $('.option').select2({
        width: 'resolve'
    });

    var edit = false;
    var funcion;

    buscar_producto();
    rellenar_proveedores();

    function buscar_producto(consulta) {
        funcion = "buscar";

        $.post('../Controller/productocontroller.php', { funcion, consulta }, (response) => {
            console.log(response);
            const productos = JSON.parse(response);

            let template = '';

            productos.forEach(prod => {
                template += `
                    <div prodId="${prod.id}" prodNomb="${prod.nombre}" prodPro="${prod.proveedor}" prodPre="${prod.precio}"  prodAvatar="${prod.avatar}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <div class="card text-white bg-light d-flex flex-fill">
                    <div class="card-header text-muted border-bottom-0">
                      <i class="fas fa-lg fa-cubes mr-1"></i> ${prod.existencia}
                    </div>
                    <div class="card-body pt-0">
                      <div class="row">
                        <div class="col-7">
                          <h2 class="lead"><b>${prod.nombre}</b></h2>
                          <h4 class="lead"><b><i class="fas fa-lg fa-dollar-sign mr-1"></i>${prod.precio}</b></h4>
                          <ul class="ml-4 mb-0 fa-ul text-muted">
                            <li class="small"><span class="fa-li  mr-1"><i class="fas fa-lg fa-truck-moving"></i></span><b>Proveedor:</b> ${prod.proveedor}</li>
                          </ul>
                        </div>
                        <div class="col-5 text-center">
                          <img src="${prod.avatar}" alt="user-avatar" class="img-circle img-fluid">
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <div class="text-right">
                        <button  class="avatar btn btn-sm bg-teal" type="button" data-toggle="modal" data-target="#cambiologo">
                          <i class="fas fa-image"></i>
                        </button>
                        <button class="agregar btn btn-sm btn-info"  type="button" data-toggle="modal" data-target="#ingresar">
                          <i class="fas  fa-plus-circle"></i> 
                        </button>

                        <button class="editar-prod btn btn-sm btn-success"  type="button" data-toggle="modal" data-target="#boton_crear">
                          <i class="fas fa-pencil-alt"></i> 
                        </button>
                        <button class="borrar btn btn-sm btn-danger">
                          <i class="fas fa-trash-alt"></i> 
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                `;
            });

            $('#productos').html(template);
        });
    }

    $(document).on('keyup', '#buscar', function() {
        let valor = $(this).val();

        if (valor != "") {
            buscar_producto(valor);
        } else {
            buscar_producto();
        }
    });


    function rellenar_proveedores() {
        funcion = 'rellenar_proveedores';
        $.post('../Controller/proveedorcontroller.php', { funcion }, (Response) => {
            // console.log(Response);
            const proveedores = JSON.parse(Response);
            let template = '';
            proveedores.forEach(provedor => {
                template += `
                <option value="${provedor.id}">${provedor.nombre}</option>
                `;
            });
            $('#proveedor').html(template);
        })
    }


    $('#form_crear_prod').submit(e => {
        let id = $('#id_producto_edit').val();
        let producto_nombre = $('#producto_nombre').val();
        let precio = $('#precio').val();
        let proveedor = $('#proveedor').val();


        if (edit == true) {
            funcion = "editar";
        } else {
            funcion = "crear";
        }

        $.post('../Controller/productocontroller.php', { funcion, id, producto_nombre, precio, proveedor }, (response) => {
            console.log(response);
            if (response == 'add') {
                $('#agrega').hide('slow');
                $('#agrega').show(1000);
                $('#agrega').hide(2000);
                $('#form_crear_prod').trigger('reset');
                buscar_producto();
            }
            if (response == 'edit') {
                $('#edit_prod').hide('slow');
                $('#edit_prod').show(1000);
                $('#edit_prod').hide(2000);
                $('#form_crear_prod').trigger('reset');
                $('#proveedor').val('').trigger('change');
                buscar_producto();
            }
            if (response == 'noadd') {
                $('#noadd').hide('slow');
                $('#noadd').show(1000);
                $('#noadd').hide(2000);
                $('#form_crear_prod').trigger('reset');
                $('#proveedor').val('').trigger('change');
            }
            if (response == 'noedit') {
                $('#noadd').hide('slow');
                $('#noadd').show(1000);
                $('#noadd').hide(2000);
                $('#form_crear_prod').trigger('reset');
            }

            edit = false;
        });
        e.preventDefault();
    });


    $(document).on('click', '.editar-prod', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        // console.log(elemento);
        const id_producto = $(elemento).attr('prodId');
        const producto = $(elemento).attr('prodNomb');
        const proveedor = $(elemento).attr('prodPro');
        const precio = $(elemento).attr('prodPre');

        $('#id_producto_edit').val(id_producto);
        $('#proveedor').val(proveedor).trigger('change');
        $('#producto_nombre').val(producto);
        $('#precio').val(precio);

        edit = true;
    });



    $(document).on('click', '.avatar', (e) => {
        funcion = "cambiar_avatar";
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('prodId');
        const nombre = $(elemento).attr('prodNomb');
        const avatar = $(elemento).attr('prodAvatar');
        $('#logoactual').attr('src', avatar);
        $('#nombre_logo').html(nombre);
        $('#funcion').val(funcion);
        $('#id-logo-prod').val(id);

    });

    $('#form-logo').submit(e => {

        let formData = new FormData($('#form-logo')[0]);

        $.ajax({
            url: '../Controller/productocontroller.php',
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false
        }).done(function(response) {
            console.log(response);
            const json = JSON.parse(response);
            if (json.alert == 'edit') {
                $('#logoactual').attr('src', json.ruta);
                $('#form-logo').trigger('reset');
                $('#edit').hide('slow');
                $('#edit').show(1100);
                $('#edit').hide(4000);
                buscar_producto();
            } else {
                $('#noedit').hide('slow');
                $('#noedit').show(1100);
                $('#noedit').hide(4000);
                $('#form-logo').trigger('reset');
            }
        });

        e.preventDefault();
    });

    $(document).on('click', '.borrar', (e) => {
        funcion = 'borrar';
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('prodId');
        const nombre = $(elemento).attr('prodNomb');
        const avatar = $(elemento).attr('ProdAvatar');

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger mr-1'
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: 'Desea Eliminar ' + nombre + '?',
            text: "No Podras Revertir Esto!",
            imageUrl: '' + avatar + '',
            imageWidth: 100,
            ImageHeight: 100,
            showCancelButton: true,
            confirmButtonText: 'Si,  Borrar Esto!',
            cancelButtonText: 'No,  Cancelar!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('../Controller/productocontroller.php', { id, funcion }, (response) => {
                    console.log(response);
                    edit == false;
                    if (response == 'borrado') {
                        swalWithBootstrapButtons.fire(
                            'Borrado!',
                            'El Producto  ' + nombre + ' Fue Borrado.',
                            'success'
                        );

                        buscar_producto();

                    } else {
                        swalWithBootstrapButtons.fire(
                            'No Se Pudo Borrar!',
                            'El Producto  ' + nombre + ' No Fue Borrado Porque Tiene Stock Disponible!',
                            'error'
                        );
                    }
                })
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'No Se Pudo Borrar',
                    'El Producto ' + nombre + ' No Fue Borrado.)',
                    'error'
                );
            }
        });
    });

    $(document).on('click', '.agregar', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;

        const id = $(elemento).attr('prodId');
        const nombre = $(elemento).attr('prodNomb');

        $('#id_producto_entrada').val(id);
        $('#nombre_producto').html(nombre);

    });

    $('#form_crear_entrada').submit(e => {
        let id_producto = $('#id_producto_entrada').val();
        let cantidad = $('#cantidad_lot').val();
        let precio = $('#precio_lot').val();

        funcion = 'crear';

        $.post('../Controller/entradacontroller.php', { funcion, id_producto, cantidad, precio }, (response) => {
            if (response == 'add') {
                $('#agrego').hide('slow');
                $('#agrego').show(1000);
                $('#agrego').hide(2000);
                $('#form_crear_entrada').trigger('reset');
                buscar_producto();
            } else {
                $('#noag').hide('slow');
                $('#noag').show(1100);
                $('#noag').hide(4000);
                $('#orm_crear_entrada').trigger('reset');
            }
        });

        e.preventDefault();
    });

    // $(document).on('click', '#boton_reporte', (e) => {
    //     Mostrar_Loader("generarReportesPDF");
    //     funcion = 'reporte_productos';
    //     $.post('../controlador/productoController.php', { funcion }, (Response) => {
    //         console.log(Response);
    //         if (Response == "") {
    //             Cerrar_loader("exito_reporte");
    //             window.open('../pdf/pdf-' + funcion + '.pdf', '_blank');
    //         } else {
    //             Cerrar_loader("error_reporte");
    //         }
    //     })
    // })

    // $(document).on('click', '#boton_reporteExcel', (e) => {
    //     // Mostrar_Loader("generarReportesPDF");
    //     funcion = 'reporte_productosExcel';
    //     $.post('../controlador/productoController.php', { funcion }, (Response) => {
    //         console.log(Response);
    //         if (Response == "") {
    //             // Cerrar_loader("exito_reporte");
    //             window.open('../Excel/reporte_productos.xlsx', '_blank');
    //         } else {
    //             // Cerrar_loader("error_reporte");
    //         }
    //     })
    // })

});