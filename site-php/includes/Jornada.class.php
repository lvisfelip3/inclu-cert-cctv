<?php
    require_once('Database.class.php');

    class Client{
        public static function create_jornada($name){
            $database = new Database();
            $conn = $database->getConnection();
            $stmt = $conn->prepare('INSERT INTO cctv_jornada(nombre,estado)
                VALUES(:name, 0)');
            $stmt->bindParam(':name',$name);
            if($stmt->execute()){
                header('HTTP/1.1 201 Jornada creado correctamente');
            } else {
                header('HTTP/1.1 404 Jornada no se ha creado correctamente');
            }
        }

        public static function delete_jornada_by_id($id){
            $database = new Database();
            $conn = $database->getConnection();

            $stmt = $conn->prepare('DELETE FROM cctv_jornada WHERE id=:id');
            $stmt->bindParam(':id',$id);
            if($stmt->execute()){
                header('HTTP/1.1 201 Jornada borrad correctamente');
            } else {
                header('HTTP/1.1 404 Jornada no se ha podido borrar correctamente');
            }
        }

        public static function get_all_jornadas(){
            $database = new Database();
            $conn = $database->getConnection();
            $stmt = $conn->prepare('SELECT * FROM cctv_jornada');
            if($stmt->execute()){
                $result = $stmt->fetchAll();
                echo json_encode($result);
                header('HTTP/1.1 201 OK');
            } else {
                header('HTTP/1.1 404 No se ha podido consultar Jornada');
            }
        }

        public static function get_jornada_by_id($id){
            $database = new Database();
            $conn = $database->getConnection();
            $stmt = $conn->prepare('SELECT * FROM cctv_jornada WHERE id=:id');
            $stmt->bindParam(':id',$id);
            if($stmt->execute()){
                $result = $stmt->fetchAll();
                echo json_encode($result);
                header('HTTP/1.1 201 OK');
            } else {
                header('HTTP/1.1 404 No se ha podido consultar las Jornada');
            }
        }

        public static function update_jornada($id, $name, $estado){
            $database = new Database();
            $conn = $database->getConnection();

            $stmt = $conn->prepare('UPDATE cctv_jornada SET nombre=:name, estado=:estado WHERE id=:id');
            $stmt->bindParam(':name',$name);
            $stmt->bindParam(':estado',$estado);
            $stmt->bindParam(':id',$id);

            if($stmt->execute()){
                header('HTTP/1.1 201 Jornada actualizado correctamente');
            } else {
                header('HTTP/1.1 404 Jornada no se ha podido actualizar correctamente');
            }

        }
    }

?>