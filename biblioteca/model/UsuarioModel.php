<?php
require_once __DIR__ . '/../config/database.php';
class UsuarioModel {
    private $db;
    private $table = "usuario";

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }
    public function getAllUsuarios() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getUsuarioById($id_usuario) {
        $query = "SELECT * FROM " . $this->table . " WHERE id_usuario = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public function createUsuario($nombre, $email, $telefono) {
        $query = "INSERT INTO " . $this->table . " (nombre, correo, telefono) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sss', $nombre, $email, $telefono);
        return $stmt->execute();
    }
    public function updateUsuario($id_usuario, $nombre, $email, $telefono) {
        $query = "UPDATE " . $this->table . " SET nombre = ?, correo = ?, telefono = ? WHERE id_usuario = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssi', $nombre, $email, $telefono, $id_usuario);
        return $stmt->execute();
    }
    public function deleteUsuario($id_usuario) {
        $query = "DELETE FROM " . $this->table . " WHERE id_usuario = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id_usuario);
        return $stmt->execute();
    }
}
?>