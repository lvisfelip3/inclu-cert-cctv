<?php
include("./includes/Database.class.php");

require_once('./includes/Users.class.php');
require_once('./includes/Perfil.class.php');

$usuarios = Users::get_all_users();
$perfiles = Perfil::get_all_perfiles();

?>

<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="card mb-4">
            <div class="card-header p-3 d-flex justify-content-between align-items-center">
                <button class="btn btn-primary d-flex alignt-items-center jusitfy-content-center gap-2 fs-5" id="addUser">Agregar Usuario<i class="material-icons" style="height: 20px; width:20px;">add</i></button>
            </div> <!-- /.card-header -->
            <div class="card-body p-0 table-responsive">
                <table class="table table-striped table-hover w-100" id="tabla">
                    <thead>
                        <tr>
                            <th class="text-center">
                                ID
                            </th>
                            <th>
                                Perfil
                            </th>
                            <th>
                                Nombres
                            </th>
                            <th>
                                Apellidos
                            </th>
                            <th>
                                Email
                            </th>
                            <th class="text-start">
                                Fecha de Creación
                            </th>
                            <th>
                                Estado
                            </th>
                            <th class="text-center">
                                Opciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>      
        </div> <!-- /.card -->
        <!-- begin::Modal -->

        <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between align-items-center">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario</h5>
                        <button type="button" class="btn-close border-0 rounded-2" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formUsuarios" name="formUsuarios">    
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="col-form-label w-100">Nombres:
                                            <input type="text" class="form-control" id="nombres">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="col-form-label w-100">Apellidos:
                                            <input type="text" class="form-control" id="apellidos">
                                        </label>
                                    </div>
                                </div>    
                            </div>
                            <div class="row"> 
                                <div class="col-md-8 mb-3">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="col-form-label w-100">Email:
                                            <input type="email" class="form-control" id="email">
                                        </label>
                                    </div>
                                </div>               
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label class="col-form-label w-100">Perfil:
                                            <select class="form-select" name="id_perfil" id="id_perfil">
                                                <?php foreach ($perfiles as $perfil): ?>
                                                    <option value="<?php echo $perfil['id']?>" ><?php echo htmlspecialchars($perfil['nombre']);?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </label>
                                    </div>
                                </div>  
                            </div>
                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <div class="form-group">
                                        <label class="col-form-label w-100" id="label_contraseña">Contraseña:
                                            <input type="password" class="form-control" id="password">
                                            <button type="button" id="cambiar_contraseña" class="btn btn-secondary form-control" hidden>Cambiar Contraseña</button>
                                        </label>
                                    </div>
                                </div>    
                                <div class="col-md-4 mb-3">    
                                    <div class="form-group">
                                        <label class="col-form-label w-100">Estado:
                                            <select class="form-select" name="estado" id="estado">
                                                    <option value="1">Activo</option>
                                                    <option value="0">Inactivo</option>
                                            </select>
                                        </label>
                                    </div>           
                                </div>    
                            </div>                
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
                        </div>
                    </form>    
                </div>
            </div>
        </div>

        <div class="modal fade" id="warningModal" tabindex="-1" aria-labelledby="warningModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    </div>
                    <div class="modal-body col-12">
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        <!-- end::Modal -->
    </div> <!--end::Container-->
</div> <!--end::App Content-->
<!-- begin::Script -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>

    //Crear Usuario
    $("#addUser").click(function(){
        $('#formUsuarios').attr('data-action', 'create_user');
        $('#formUsuarios')[0].reset();
        $('#modalCRUD .modal-title').text('Agregar Usuario');
        $('#modalCRUD').modal('show');
    });

    //Editar Usuario
    $('#tabla tbody').on('click', '.btnEditar', function() {
        var data = tablaUsuarios.row($(this).parents('tr')).data();
        $('#formUsuarios').attr('data-action', 'edit_user');
        $('#formUsuarios').attr('data-id', data.id);
        $('#id_perfil').val(data.id_perfil);
        $('#nombres').val(data.nombres);
        $('#apellidos').val(data.apellidos);
        $('#email').val(data.email);    
        $('#estado').val(data.estado);
        $('#cambiar_contraseña').prop('hidden', false);
        $('#password').prop('hidden', true);
        $('#cambiar_contraseña').click(function(){
            $('#password').prop('hidden', false);
            $('#cambiar_contraseña').prop('hidden', true);
        });
        $('#password').val('');
        $('#modalCRUD .modal-title').text('Editar Usuario');

        $('#modalCRUD').modal('show');
    });

    //Formatear Modal
    $('#warningModal').on('hidden.bs.modal', function() {    
        var modal = $('#warningModal .modal-dialog .modal-content');
        modal.find('.modal-header h5').remove();
        modal.find('.modal-body p').remove();
        modal.find('.modal-footer button').remove();
    });
    //Eliminar Usuario
    $('#tabla tbody').on('click', '.btnBorrar', function() {
        var $row = $(this).closest('tr');  // Capturamos la fila correctamente
        var data = tablaUsuarios.row($row).data();
        var userId = data.id;
        var modal = $('#warningModal .modal-dialog .modal-content');
        
        modal.find('.modal-header').append('<h5 class="modal-title" id="warningModalLabel">Atención!</h5>');
        modal.find('.modal-body').append('<p>¿Seguro que deseas eliminar este registro? Esta acción no se puede revertir.</p>');
        modal.find('.modal-body').append('<p>ID: '+data.id+'</p>');
        modal.find('.modal-body').append('<p>Usuario: '+data.nombres +' '+data.apellidos+'</p>');
        modal.find('.modal-body').append('<p>Perfil: '+perfilesMap[data.id_perfil]+'</p>');
        modal.find('.modal-body').append('<p>Email: '+data.email+'</p>');
        modal.find('.modal-body').append('<p>Fecha de Creación: '+data.fecha_creacion+'</p>');
        modal.find('.modal-body').append('<p>Estado: '+(data.estado ? 'Activo' : 'Inactivo')+'</p>');
        modal.find('.modal-footer').append('<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>');
        modal.find('.modal-footer').append('<button type="button" class="btn btn-danger btnBorrar" data-bs-dismiss="modal">Eliminar</button>');
        $('#warningModal').modal('show');
        $('#warningModal').on('click', '.btnBorrar', function(){
            $.ajax({
                type: "POST",
                url: "./ajax_handler/users.php",
                data: { action: 'delete_user', id: userId },
                datatype: "json",
                encode: true,
                success: function(response) {
                    if (response.status) {
                        // Remover la fila de la tabla
                        tablaUsuarios.row($row).remove().draw()  ;
                    } else {
                        alert(response.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Manejar errores de AJAX
                    console.log("Error en AJAX: " + textStatus, errorThrown);
                    alert("Error en la solicitud: " + textStatus);
                }
            });
        });
    });

    var perfiles = <?php echo json_encode($perfiles); ?>;
    var perfilesMap = {};

    // Convertir el array de perfiles a un mapa para un acceso más rápido
    perfiles.forEach(function(perfil) {
        perfilesMap[perfil.id] = perfil.nombre;
    });
    
    $(document).ready( function(){
        tablaUsuarios =  $('#tabla').DataTable({
            responsive: true,
            "ajax": {            
                "url": "./ajax_handler/users.php",
                "type": 'POST',
                "data": {action: 'get_users'},
                "dataSrc": ""
            },
            "columns":[
                {   
                    "data": "id",
                    "createdCell": function(td, cellData, rowData, row, col) {
                        $(td).addClass('text-center');
                    }
                },
                {
                    "data": "id_perfil",
                    "render": function(data) {
                        return perfilesMap[data] || 'Desconocido';
                    }
                },
                {   
                    "data": "nombres",
                    "createdCell": function(td, cellData, rowData, row, col) {
                        $(td).addClass('text-capitalize');
                    }
                },
                {   
                    "data": "apellidos",
                    "createdCell": function(td, cellData, rowData, row, col) {
                        $(td).addClass('text-capitalize');
                    }
                },
                {"data": "email"},
                {
                    "data": "fecha_creacion",
                    "createdCell": function(td, cellData, rowData, row, col) {
                        $(td).addClass('text-start');
                    }
                },
                {
                    "data": "estado",
                    "render": function(data, type, row) {
                        return data == 1 ? 'Activo' : 'Inactivo';
                    }
                },
                {"defaultContent": "<div class='text-center d-inline-block d-md-block'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btnBorrar'><i class='material-icons'>delete</i></button></div></div>"}
            ],
            "createdRow": function(row, data, dataIndex) {
            $(row).attr('data-id', data.id); // Añadir atributo data-id
            },
            "language": {
                "url": "./assets/json/espanol.json"
            }

        });
    });
</script>
<script>
    // fomrulario Subir/Editar usuarios

    $("#formUsuarios"). submit(function(e) {
        e.preventDefault();

        var action = $(this).attr('data-action');
        var id = $(this).attr('data-id') || null;

        var formData = {
            action: action,
            id:id,
            id_perfil: $.trim($("#id_perfil").val()),
            nombres: $.trim($("#nombres").val()),
            apellidos: $.trim($("#apellidos").val()),
            email: $.trim($("#email").val()),
            password: $.trim($("#password").val()),
            estado: $.trim($("#estado").val())
        };
        $.ajax({
            type: "POST",
            url: "./ajax_handler/users.php",
            data: formData,
            datatype: "json",
            encode: true,
            success: function(data) {
                if (data.status) {
                    if (action === 'create_user'){
                        var newRow = tablaUsuarios.row.add({
                                "id": data.user.id,
                                "id_perfil": data.user.id_perfil,
                                "email": data.user.email,
                                "nombres": data.user.nombres,
                                "apellidos": data.user.apellidos,
                                "fecha_creacion": data.user.fecha_creacion,
                                "estado": data.user.estado
                            }).draw().node();
                            $(newRow).attr('data-id', data.user.id);
                            $('#modalCRUD').modal('hide');
                    }else if (action === 'edit_user'){
                        var row = tablaUsuarios.row($('[data-id="' + id + '"]'));
                        row.data({
                            "id": id,
                            "id_perfil": formData.id_perfil,
                            "email": formData.email,
                            "nombres": formData.nombres,
                            "apellidos": formData.apellidos,
                            "estado": formData.estado,
                            "fecha_creacion": row.data().fecha_creacion // Mantener la fecha de creación existente
                        }).draw();
                        $('#modalCRUD').modal('hide');

                    }
                    
                } else {
                    alert(data.message);
                } },
            error:function(jqXHR, textStatus, errorThrown) {
                // Manejar errores de AJAX
                console.log("Error en AJAX: " + textStatus, errorThrown);
                alert("Error en la solicitud: " + textStatus);
            } 
        });
        });
</script>
<!-- end::Script -->
    
</body>
</html>