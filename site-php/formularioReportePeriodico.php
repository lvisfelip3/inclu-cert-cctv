<?php
include("./includes/Database.class.php");

require_once('./includes/Clientes.class.php');
require_once('./includes/Plantas.class.php');
require_once('./includes/Operadores.class.php');

$operadores = Operadores::get_all_operadores_without_turno();

if (isset($_GET['cliente'])) {
    $id = $_GET['cliente'];
    $cliente = Clientes::get_cliente_by_id($id);
    $plantas = Plantas::get_plantas_by_cliente_id($id);
};
?>

<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="col-12"> <!--begin::Quick Example-->
            <div class="card card-primary card-outline mb-2">
                <!--begin::Header-->
                <div class="card-header d-flex justify-content-start align-items-center">
                    <div class="card-title col-6 col-md-8 fw-bold">Ingreso Reporte Diario</div>
                    <div class="card-title col-6 col-md-4 fw-bold d-flex justify-content-end""><?php echo $cliente['nombre']; ?></div>
                </div>
                <!--end::Header--> 
                <!--begin::Card-body-->
                <div class="card-body">
                    <?php foreach ($plantas as $planta): ?>
                    <form id="formReporte_<?php echo $planta['id']; ?>" name="formReporte_<?php echo $planta['id']; ?>">
                        <div class="row align-items-center">
                            <h4 class="m-0 fw-medium text-capitalize"><?php echo $planta['nombre']; ?></h1>
                            <div class="col-md-2 mb-3">
                                <div class="form-group">
                                    <label class="col-form-label w-100">N° de Cámaras:
                                        <input class="form-control" type="number" name="camaras_<?php echo $planta['id']; ?>" id="camaras_<?php echo $planta['id']; ?>" disabled required value="<?php echo $planta['camaras']; ?>">
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <div class="form-group">
                                    <label class="col-form-label w-100">N° de Cámaras en Línea:
                                        <input class="form-control" type="number" name="camaras_online_<?php echo $planta['id']; ?>" id="camaras_online_<?php echo $planta['id']; ?>" required>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <div class="form-group">
                                    <label class="col-form-label w-100">Canal de Visualización:
                                        <input class="form-control" type="number" name="canal_<?php echo $planta['id']; ?>" id="canal_<?php echo $planta['id']; ?>" required>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <div class="form-group">
                                    <label class="col-form-label w-100">Operador:
                                        <select class="form-select" name="id_operador_<?php echo $planta['id']; ?>" id="id_operador_<?php echo $planta['id']; ?>" required>
                                            <option value="">Seleccione</option>
                                            <?php foreach ($operadores as $operador): ?>
                                            <option value="<?php echo $operador['id']?>"><?php echo htmlspecialchars($operador['nombre']);?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="col-form-label w-100">Observación:
                                        <textarea name="observacion_<?php echo $planta['id']; ?>" id="observacion_<?php echo $planta['id']; ?>" class="form-control" required></textarea>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php endforeach; ?>
                </div>
                <!-- end Card-body -->
                <!-- begin Card-footer -->
                <div class="card-footer d-flex gap-2">
                    <a href="<?php echo $base_url?>/formularios.php?&form=periodico&token=<?php echo $token;?>" class="btn btn-light">Volver</a>
                    <button
                    type="button"
                    id="btnGuardar" 
                    class="btn btn-dark">
                        Guardar
                    </button>
                </div>
                <!-- end Card-footer -->   
                <!-- begin Modal-Success -->
                <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="successModalLabel">Éxito</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end Modal-Success -->
            </div>
        </div>
    </div>
</div> <!--end::Container-->
<!-- begin::Script -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('#btnGuardar').click(function() {
            <?php foreach ($plantas as $planta): ?>
                var formData = {
                    action: 'create_reporte',
                    id_cliente: <?php echo $cliente['id']; ?>,
                    id_planta: <?php echo $planta['id']; ?>,
                    id_operador: $.trim($("#id_operador_<?php echo $planta['id']; ?>").val()),
                    camaras_online: $.trim($("#camaras_online_<?php echo $planta['id']; ?>").val()),
                    camaras: $.trim($("#camaras_<?php echo $planta['id']; ?>").val()),
                    canal: $.trim($("#canal_<?php echo $planta['id']; ?>").val()),
                    observacion: $.trim($("#observacion_<?php echo $planta['id']; ?>").val())
                };

                $.ajax({
                    type: "POST",
                    url: "./ajax_handler/reportes.php",
                    data: formData,
                    datatype: "json",
                    encode: true,
                    success: function(data) {
                        let modal = $('.modal-body');
                        console.log(data);
                        if (data.status) {
                            modal.empty();
                            modal.append('<p>'+data.message+'</p>');
                            modal.append('<p> Planta: <?php echo $planta['nombre']; ?></p>');
                            modal.append('<p> Fecha: '+data.reporte.fecha+'</p>');
                            modal.append('<p> Camaras en Línea: '+data.reporte.camaras_online+'</p>');
                            modal.append('<p> Canal: '+data.reporte.canal+'</p>');
                            modal.append('<p> Observación: '+data.reporte.observacion+'</p>');
                            modal.append('<a class="btn btn-primary" href="<?php echo $base_url?>/formularios.php?&form=periodico&token=<?php echo $token;?>">Ver Reportes</a>');
                            $('#successModal').modal('show');
                            $('#formReporte_<?php echo $planta['id']; ?>').trigger('reset');
                        } else {
                            modal.empty();
                            modal.append('<p>'+data.message+'</p>');
                            modal.append('<p>'+data.message+'</p>');
                            $('#successModal').modal('show');
                        }
                    }
                });
            <?php endforeach; ?>
        });
    });
</script>
<!-- end::Script -->
    
</body>
</html>