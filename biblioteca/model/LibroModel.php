<?php
require_once __DIR__ . '/../config/database.php';

class LibroModel {
    private $db;
    private $table = "libro";

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }
    public function getAllLibros() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getLibroById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id_libro = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public function createLibro($titulo, $autor, $año_publicacion) {
        $query = "INSERT INTO " . $this->table . " (titulo, autor, año_publicacion) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sss', $titulo, $autor, $año_publicacion);
        return $stmt->execute();
    }
    public function updateLibro($id, $titulo, $autor, $año_publicacion) {
        $query = "UPDATE " . $this->table . " SET titulo = ?, autor = ?, año_publicacion = ? WHERE id_libro = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssi', $titulo, $autor, $año_publicacion, $id);
        return $stmt->execute();
    }
    public function deleteLibro($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id_libro = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}
?>