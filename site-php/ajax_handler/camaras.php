<?php
require_once('../includes/Plantas.class.php');
require_once('../includes/Camaras.class.php');
header('Content-Type: application/json');

if (isset($_POST)) {
    $action = $_POST['action'];

    switch ($action) {

        case 'create_camara':
            $idPlanta = $_POST['id_planta'];
            $nombre = $_POST['nombre'];
            $modelo = $_POST['modelo'];
            $tipoCamara = $_POST['tipo_camara'];
            $sn = $_POST['sn'];
            $estado = $_POST['estado'];

            $response = Camaras::create_camaras($idPlanta, $nombre, $modelo, $tipoCamara, $sn, $estado);

            if ($response['status']) {
                $database = new Database();
                $conn = $database->getConnection();
                $stmt = $conn->prepare('SELECT * FROM cctv_camaras WHERE nombre = :nombre');
                $stmt->bindParam(':nombre', $nombre);
                $stmt->execute();
                $newCamara = $stmt->fetch(PDO::FETCH_ASSOC);
                $response['camara'] = $newCamara;
            }

            echo json_encode($response);
            break;

        case 'updateClienteSelect':
            $id = $_POST['id'];

            $response = Camaras::get_plantas_by_cliente_id($id);

            echo json_encode($response);
            break;

        case 'get_camaras':

            $id_planta = $_POST['planta'];
            $id_cliente = $_POST['cliente'];

            $response = Camaras::get_all_camaras($id_cliente, $id_planta);

            echo json_encode($response);
            break;

        case 'edit_camara':
            $id = $_POST['id'];
            $idPlanta = $_POST['id_planta'];
            $nombre = $_POST['nombre'];
            $estado = $_POST['estado'];

            $response = Camaras::update_camaras($id, $idPlanta, $nombre, $estado);

            if ($response['status']) {
                $database = new Database();
                $conn = $database->getConnection();
                $stmt = $conn->prepare('SELECT * FROM cctv_camaras WHERE id = :id');
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $updatedCamara = $stmt->fetch(PDO::FETCH_ASSOC);
                $response['camara'] = $updatedCamara;
            }

            echo json_encode($response);
            break;

        case 'delete_camara':
            $id = $_POST['id'];
            $response = Camaras::delete_camaras_by_id($id);
            echo json_encode($response);
            break;
            // Otros casos para update, delete, etc.
    }
}
