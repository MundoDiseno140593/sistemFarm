$(document).ready(function() {
    buscar_datos();

    var funcion;

    function buscar_datos(consulta) {

        funcion = 'buscar_datos';

        $.post('../Controller/clientecontroller.php', { consulta, funcion }, (response) => {
            console.log(response);
            const clientes = JSON.parse(response);
            let template = '';
            clientes.forEach(cliente => {
                template += `
                <div CliId="${cliente.id}" CliNombre="${cliente.nombre}"  CliApellido="${cliente.apellido}" CliNit="${cliente.nit}" CliTelefono="${cliente.telefono}" CliDireccion="${cliente.direccion}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                <div class="card text-white bg-light d-flex flex-fill">
                  <div class="card-header text-muted border-bottom-0">
                    <h1 class="badge badge-success">Cliente</h1>
                  </div>
                  <div class="card-body text-primary pt-0">
                    <div class="row">
                      <div class="col-8">
                        <h2 class="lead"><b>${cliente.nombre} ${cliente.apellido}</b></h2>
   
                        <ul class="ml-4 mb-0 fa-ul pt-4">
                          <li class="small"><span class="fa-li"><i class="fas fa-id-card fa-lg"></i> </span> Codigo:  ${cliente.nit}</li>
                          <li class="small"><span class="fa-li"><i class="fas fa-regular fa-phone mr-1 fa-lg"></i> </span> Telefono:   ${cliente.telefono}</li>
                          <li class="small"><span class="fa-li"><i class="fas fa-regular fa-map-marked-alt mr-1 fa-lg"></i> </span> Direccion:   ${cliente.direccion}</li>
                        </ul>
                      </div>
                      <div class="col-4 text-center">
                      <img src="../img/cliente/cliente.jpg" alt="user-avatar" class="img-circle img-fluid" width="150" height="160">
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="text-right">
                      <button class="editar btn btn-sm btn-secondary"  type="button" data-toggle="modal" data-target="#editar_cliente">
                        <i class="fas fa-pencil-alt"></i> 
                      </button>
                      <button class="borrar btn btn-sm btn-danger">
                        <i class="fas fa-trash-alt"></i> 
                      </button>
                    </div>
                  </div>
                </div>
              </div>`;

            });
            $('#clientes').html(template);

        });
    }

    $(document).on('keyup', '#buscar', function() {
        let valor = $(this).val();

        if (valor != "") {
            buscar_datos(valor);
        } else {
            buscar_datos();
        }
    });


    $('#form_crear').submit(e => {
        let nit = $('#nit').val();
        let nombre = $('#nombre').val();
        let apellido = $('#apellido').val();
        let telefono = $('#telefono').val();
        let direccion = $('#direccion').val();

        funcion = 'crear_cliente';

        $.post('../Controller/clientecontroller.php', { nit, nombre, apellido, telefono, direccion, funcion }, (response) => {
            console.log(response);

            if (response == 'agregado') {
                $('#agregado').hide('slow');
                $('#agregado').show(1100);
                $('#agregado').hide(4000);
                $('#form_crear').trigger('reset');
                buscar_datos();
            } else {
                $('#error').hide('slow');
                $('#error').show(1100);
                $('#error').hide(4000);
                $('#form_crear').trigger('reset');
            }


        });

        e.preventDefault();
    });





    $(document).on('click', '.borrar', (e) => {
        funcion = 'borrar';
        let elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        let id = $(elemento).attr('CliId');
        let nombre = $(elemento).attr('CliNombre');

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger mr-1'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Desea Eliminar ' + nombre + '?',
            text: "No Podras Revertir Esto!",
            showCancelButton: true,
            confirmButtonText: 'Si,  Borrar Esto!',
            cancelButtonText: 'No,  Cancelar!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('../Controller/clientecontroller.php', { id, funcion }, (response) => {
                    console.log(response);
                    if (response == 'borrado') {
                        swalWithBootstrapButtons.fire(
                            'Borrado!',
                            'El Cliente  ' + nombre + ' Fue Borrado.',
                            'success'
                        )

                        buscar_datos();

                    } else {
                        swalWithBootstrapButtons.fire(
                            'No Se Pudo Borrar!',
                            'El Cliente  ' + nombre + ' No Fue Borrado!',
                            'error'
                        )
                    }
                })
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'No Se Pudo Borrar',
                    'El Cliente ' + nombre + ' No Fue Borrado.)',
                    'error'
                )

            }
        })

    });





    // capturamos los datos del model editar
    $(document).on('click', '.editar', (e) => {
        let elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        console.log(elemento);
        let nit = $(elemento).attr('CliNit');
        let nombre = $(elemento).attr('CliNombre');
        let apellido = $(elemento).attr('CliApellido');
        let telefono = $(elemento).attr('CliTelefono');
        let id = $(elemento).attr('CliId');
        let direccion = $(elemento).attr('CliDireccion');

        $('#nit_edit').val(nit);
        $('#nombre_edit').val(nombre);
        $('#apellido_edit').val(apellido);
        $('#telefono_edit').val(telefono);
        $('#direccion_edit').val(direccion);
        $('#id_cliente').val(id);
    });

    $('#form_editar').submit(e => {
        let id_cliente = $('#id_cliente').val();
        let nombre = $('#nombre_edit').val();
        let apellido = $('#apellido_edit').val();
        let telefono = $('#telefono_edit').val();
        let direccion = $('#direccion_edit').val();
        funcion = 'edito';

        $.post('../Controller/clientecontroller.php', { id_cliente, nombre, apellido, telefono, direccion, funcion }, (response) => {
            console.log(response);

            if (response == 'edito') {
                $('#editar__cliente').hide('slow');
                $('#editar__cliente').show(1000);
                $('#editar__cliente').hide(2000);
                $('#form_editar').trigger('reset');
                buscar_datos();
            }

            if (response == 'noedito') {
                $('#no_editar-cliente').hide('slow');
                $('#no_editar-cliente').show(1000);
                $('#no_editar-cliente').hide(2000);
                $('#form_editar').trigger('reset');
            }
        });
        e.preventDefault();
    });

});