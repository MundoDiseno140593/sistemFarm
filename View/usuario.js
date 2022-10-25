$(document).ready(function() {
    $('.option').select2({
        width: 'resolve'
    });
    var tipo_usuario = $('#tipo_usuario').val();
    // console.log(tipo_usuario);
    if (tipo_usuario == 2 || tipo_usuario == 3) {
        $('#btn_crear').hide();
        $('#reporte').hide();
    }
    rellenar_tipo();
    rellenar_tipo_edit();
    buscar_datos();

    var funcion;

    function buscar_datos(consulta) {

        funcion = 'buscar_datos';

        $.post('../Controller/usuariocontroller.php', { consulta, funcion }, (response) => {
            console.log(response);
            const usuarios = JSON.parse(response);
            let template = '';
            usuarios.forEach(usuario => {
                template += `
            <div UsId="${usuario.id}" UsNombre="${usuario.nombre}" UsCorreo="${usuario.correo}" UsUsuario="${usuario.usuario}" UsTipo="${usuario.tipo}"class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card text-black bg-light bg-whited-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">`;
                if (usuario.tipo_usuario == 3) {
                    template += `<h1 class="badge badge-danger">${usuario.tipo}</h1>`;
                }
                if (usuario.tipo_usuario == 1) {
                    template += `<h1 class="badge badge-warning">${usuario.tipo}</h1>`;
                }
                if (usuario.tipo_usuario == 2) {
                    template += `<h1 class="badge badge-info">${usuario.tipo}</h1>`;
                }
                template += `</div>
                <div class="card-body text-primary pt-0">
                  <div class="row">
                    <div class="col-8">
                      <h2 class="lead"><b>${usuario.nombre}</b></h2>

                      <ul class="ml-4 mb-0 fa-ul pt-4">
                        <li class="small"><span class="fa-li"><i class="fas fa-at fa-lg"></i> </span> Correo:  ${usuario.correo}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-id-card fa-lg"></i> </span> Usuario:  ${usuario.usuario}</li>
                      </ul>
                      </ul>
                      </ul>
                    </div>
                    <div class="col-4 text-center">
                    <img src="../img/User.png" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <button class="editar btn btn-sm btn-secondary"  type="button" data-toggle="modal" data-target="#editar_usuario">
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
            $('#usuarios').html(template);


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
        let nombre = $('#nombre').val();
        let correo = $('#correo').val();
        let usuario = $('#usuario').val();
        let clave = $('#clave').val();
        let id_tipo = $('#id_tipo').val();

        funcion = 'crear_usuario';

        $.post('../Controller/usuariocontroller.php', { nombre, correo, usuario, clave, id_tipo, funcion }, (response) => {
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



    function rellenar_tipo() {
        funcion = 'rellenar_tipo';
        $.post('../Controller/tipoController.php', { funcion }, (Response) => {
            // console.log(Response);
            const tipos = JSON.parse(Response);
            let template = '';
            tipos.forEach(tipo => {
                template += `
                  <option value="${tipo.id_tip}">${tipo.nombre}</option>
                  `;
            });
            $('#id_tipo').html(template);
        })
    }


    function rellenar_tipo_edit() {
        funcion = 'rellenar_tipo_edit';
        $.post('../Controller/tipoController.php', { funcion }, (Response) => {
            // console.log(Response);
            const tipos = JSON.parse(Response);
            let template = '';
            tipos.forEach(tipo => {
                template += `
                <option value="${tipo.id_tip}">${tipo.nombre}</option>
                `;
            });
            $('#id_tipo_edit').html(template);
        });
    }

    $(document).on('click', '.borrar', (e) => {
        funcion = 'borrar';
        let elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        let id = $(elemento).attr('UsId');
        let nombre = $(elemento).attr('UsNombre');

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
                $.post('../Controller/usuariocontroller.php', { id, funcion }, (response) => {
                    console.log(response);
                    if (response == 'borrado') {
                        swalWithBootstrapButtons.fire(
                            'Borrado!',
                            'El Usuario  ' + nombre + ' Fue Borrado.',
                            'success'
                        )

                        buscar_datos();

                    } else {
                        swalWithBootstrapButtons.fire(
                            'No Se Pudo Borrar!',
                            'El Usuario  ' + nombre + ' No Fue Borrado!',
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
                    'El Usuario ' + nombre + ' No Fue Borrado.)',
                    'error'
                )

            }
        })

    });





    // capturamos los datos del model editar
    $(document).on('click', '.editar', (e) => {
        let elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        let nombre = $(elemento).attr('UsNombre');
        let correo = $(elemento).attr('UsCorreo');
        let id = $(elemento).attr('UsId');
        let id_tipo = $(elemento).attr('UsIdTipo');

        $('#nombre_edit').val(nombre);
        $('#correo_edit').val(correo);
        $('#id_tipo_edit').val(id_tipo);
        $('#id_usuario').val(id);
    });

    $('#form_editar').submit(e => {
        let id_usuario = $('#id_usuario').val();
        let nombre = $('#nombre_edit').val();
        let correo = $('#correo_edit').val();
        let id_tipo = $('#id_tipo_edit').val();
        funcion = 'edito';

        $.post('../Controller/usuariocontroller.php', { id_usuario, nombre, correo, id_tipo, funcion }, (response) => {
            console.log(response);

            if (response == 'edito') {
                $('#editar__usuario').hide('slow');
                $('#editar__usuario').show(1000);
                $('#editar__usuario').hide(2000);
                $('#form_editar').trigger('reset');
                buscar_datos();
            }

            if (response == 'noedito') {
                $('#no_editar-usuario').hide('slow');
                $('#no_editar-usuario').show(1000);
                $('#no_editar-usuario').hide(2000);
                $('#form_editar').trigger('reset');
            }
        });
        e.preventDefault();
    });

});