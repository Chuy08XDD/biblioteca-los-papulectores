<?php
require_once __DIR__ . '/../config/database.php';

class PrestamoModel {
    private $db;
    private $table = "prestamo";
    private $tableDetalle = "detalle_prestamo";
    private $lastError = null;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Obtener todos los préstamos con cantidad (JOIN con detalle_prestamo)
    public function getAllPrestamos() {
        $query = "SELECT p.*, dp.cantidad 
                  FROM " . $this->table . " p
                  LEFT JOIN " . $this->tableDetalle . " dp ON p.id_prestamo = dp.id_prestamo
                  ORDER BY p.id_prestamo DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Obtener un préstamo con su cantidad (JOIN con detalle_prestamo)
    public function getPrestamoById($id) {
        $sql = "SELECT p.*, dp.cantidad 
                FROM prestamo p
                LEFT JOIN detalle_prestamo dp ON p.id_prestamo = dp.id_prestamo
                WHERE p.id_prestamo = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Insertar préstamo
    public function insertPrestamo($data) {
        $id_libro = $data['id_libro'];
        $id_usuario = $data['id_usuario'];
        $fecha_inicio = $data['fecha_inicio'];
        $devolucion = $data['devolucion'];
        $estado = $data['estado'];
        $cantidad = $data['cantidad'];

        // Iniciar transacción
        $this->db->begin_transaction();
        try {
            // Insertar en tabla prestamo
            $sqlPrestamo = "INSERT INTO " . $this->table . " (id_libro, id_usuario, fecha_inicio, devolucion, estado) 
                            VALUES (?, ?, ?, ?, ?)";
            $stmtPrestamo = $this->db->prepare($sqlPrestamo);
            if ($stmtPrestamo === false) {
                throw new Exception($this->db->error);
            }
            $stmtPrestamo->bind_param('iisss', $id_libro, $id_usuario, $fecha_inicio, $devolucion, $estado);
            $resPrestamo = $stmtPrestamo->execute();
            if ($resPrestamo === false) {
                throw new Exception($stmtPrestamo->error);
            }
            $newPrestamoId = $this->db->insert_id;

            // Insertar en tabla detalle_prestamo
            $sqlDetalle = "INSERT INTO " . $this->tableDetalle . " (id_prestamo, cantidad) 
                           VALUES (?, ?)";
            $stmtDetalle = $this->db->prepare($sqlDetalle);
            if ($stmtDetalle === false) {
                throw new Exception($this->db->error);
            }
            $stmtDetalle->bind_param('ii', $newPrestamoId, $cantidad);
            $resDetalle = $stmtDetalle->execute();
            if ($resDetalle === false) {
                throw new Exception($stmtDetalle->error);
            }

            // Confirmar transacción
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            // Revertir transacción en caso de error
            $this->db->rollback();
            $this->lastError = $e->getMessage();
            return false;
        }
    }

    // Actualizar préstamo
    public function updatePrestamo($data) {
        $id = $data['id_prestamo'];
        $id_libro = $data['id_libro'];
        $id_usuario = $data['id_usuario'];
        $fecha_inicio = $data['fecha_inicio'];
        $devolucion = $data['devolucion'];
        $estado = $data['estado'];
        $cantidad = $data['cantidad'];
        // Iniciar transacción
        $this->db->begin_transaction();
        try {
            // Actualizar tabla prestamo
            $sqlPrestamo = "UPDATE " . $this->table . " 
                            SET id_libro = ?, id_usuario = ?, fecha_inicio = ?, devolucion = ?, estado = ? 
                            WHERE id_prestamo = ?";
            $stmtPrestamo = $this->db->prepare($sqlPrestamo);
            if ($stmtPrestamo === false) {
                throw new Exception($this->db->error);
            }
            $stmtPrestamo->bind_param('iisssi', $id_libro, $id_usuario, $fecha_inicio, $devolucion, $estado, $id);
            $resPrestamo = $stmtPrestamo->execute();
            if ($resPrestamo === false) {
                throw new Exception($stmtPrestamo->error);
            }

            // Actualizar tabla detalle_prestamo
            $sqlDetalle = "UPDATE " . $this->tableDetalle . " 
                           SET cantidad = ? 
                           WHERE id_prestamo = ?";
            $stmtDetalle = $this->db->prepare($sqlDetalle);
            if ($stmtDetalle === false) {
                throw new Exception($this->db->error);
            }
            $stmtDetalle->bind_param('ii', $cantidad, $id);
            $resDetalle = $stmtDetalle->execute();
            if ($resDetalle === false) {
                throw new Exception($stmtDetalle->error);
            }

            // Confirmar transacción
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            // Revertir transacción en caso de error
            $this->db->rollback();
            $this->lastError = $e->getMessage();
            return false;
        }
    }

    // Eliminar préstamo
    public function deletePrestamo($id) {
        // Iniciar transacción
        $this->db->begin_transaction();
        try {
            // Eliminar de tabla detalle_prestamo
            $sqlDetalle = "DELETE FROM " . $this->tableDetalle . " WHERE id_prestamo = ?";
            $stmtDetalle = $this->db->prepare($sqlDetalle);
            if ($stmtDetalle === false) {
                throw new Exception($this->db->error);
            }
            $stmtDetalle->bind_param('i', $id);
            $resDetalle = $stmtDetalle->execute();
            if ($resDetalle === false) {
                throw new Exception($stmtDetalle->error);
            }

            // Eliminar de tabla prestamo
            $sqlPrestamo = "DELETE FROM " . $this->table . " WHERE id_prestamo = ?";
            $stmtPrestamo = $this->db->prepare($sqlPrestamo);
            if ($stmtPrestamo === false) {
                throw new Exception($this->db->error);
            }
            $stmtPrestamo->bind_param('i', $id);
            $resPrestamo = $stmtPrestamo->execute();
            if ($resPrestamo === false) {
                throw new Exception($stmtPrestamo->error);
            }

            // Confirmar transacción
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            // Revertir transacción en caso de error
            $this->db->rollback();
            $this->lastError = $e->getMessage();
            return false;
        }
    }

    // Obtener detalles de préstamo (por si los necesitas aparte)
    public function getDetallesByPrestamoId($id_prestamo) {
        $sql = "SELECT * FROM " . $this->tableDetalle . " WHERE id_prestamo = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $id_prestamo);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    // Manejo de errores
    public function getLastError() {
        return $this->lastError;
    }
    public function clearLastError() {
        $this->lastError = null;
    }
}
?>