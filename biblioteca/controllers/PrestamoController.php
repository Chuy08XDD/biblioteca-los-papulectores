<?php
require_once __DIR__ . '/../model/PrestamoModel.php';
require_once __DIR__ . '/../model/UsuarioModel.php';
require_once __DIR__ . '/../model/LibroModel.php';

class PrestamoController {
    private $model;
    public function __construct() {
        $this->model = new PrestamoModel();
        $this->usuarioModel = new UsuarioModel();
        $this->libroModel = new LibroModel();
    }
    public function index() {
        $prestamos = $this->model->getAllPrestamos();
        require_once __DIR__ . '/../views/prestamo/index.php';
    }
    public function crear() {
        // Load users and books to populate select inputs
        $usuarios = $this->usuarioModel->getAllUsuarios();
        $libros = $this->libroModel->getAllLibros();
        require_once __DIR__ . '/../views/prestamo/crear.php';
    }
    public function guardar() {
        if (!isset($_POST['id_libro'], $_POST['id_usuario'], $_POST['cantidad'], $_POST['fecha_inicio'], $_POST['devolucion'], $_POST['estado'])) {
            header('Location: index.php?controller=PrestamoController&action=crear');
            exit;
        }
        $id_libro = trim($_POST['id_libro']);
        $id_usuario = trim($_POST['id_usuario']);
        $cantidad = trim($_POST['cantidad']);
        $fecha_inicio = trim($_POST['fecha_inicio']);
        $devolucion = trim($_POST['devolucion']);
        $estado = trim($_POST['estado']);

        if ($id_libro === '' || $id_usuario === '') {
            header('Location: index.php?controller=PrestamoController&action=crear');
            exit;
        }

        $data = [
            'id_libro' => $id_libro,
            'id_usuario' => $id_usuario,
            'cantidad' => $cantidad,
            'fecha_inicio' => $fecha_inicio,
            'devolucion' => $devolucion,
            'estado' => $estado
        ];
        $res = $this->model->insertPrestamo($data);
        if ($res === false) {
            $error = $this->model->getLastError();
            echo "<h3>Error al guardar el préstamo</h3>";
            echo "<pre>" . htmlspecialchars($error) . "</pre>";
            echo "<p><a href=\"index.php?controller=PrestamoController&action=crear\">Volver</a></p>";
            exit;
        }
        header('Location: index.php?controller=PrestamoController&action=index');
    }
    public function editar() {
        if (!isset($_GET['id'])) {
            header('Location: index.php?controller=PrestamoController&action=index');
            exit;
        }
        $id = $_GET['id'];
        $prestamo = $this->model->getPrestamoById($id);
        require_once __DIR__ . '/../views/prestamo/editar.php';
    }
    public function actualizar() {
        if (!isset($_POST['id'], $_POST['id_libro'], $_POST['id_usuario'], $_POST['cantidad'], $_POST['fecha_inicio'], $_POST['devolucion'], $_POST['estado'])) {
            header('Location: index.php?controller=PrestamoController&action=index');
            exit;
        }
        $id_prestamo = $_POST['id'];
        $id_libro = trim($_POST['id_libro']);
        $id_usuario = trim($_POST['id_usuario']);
        $cantidad = trim($_POST['cantidad']);
        $fecha_inicio = trim($_POST['fecha_inicio']);
        $devolucion = trim($_POST['devolucion']);
        $estado = trim($_POST['estado']);

        if ($id_libro === '' || $id_usuario === '') {
            header('Location: index.php?controller=PrestamoController&action=editar&id=' . urlencode($id));
            exit;
        }

        $data = [
            'id_prestamo' => $id_prestamo,
            'id_libro' => $id_libro,
            'id_usuario' => $id_usuario,
            'cantidad' => $cantidad,
            'fecha_inicio' => $fecha_inicio,
            'devolucion' => $devolucion,
            'estado' => $estado
        ];
        $res = $this->model->updatePrestamo($data);
        if ($res === false) {
            $error = $this->model->getLastError();
            echo "<h3>Error al actualizar el préstamo</h3>";
            echo "<pre>" . htmlspecialchars($error) . "</pre>";
            echo "<p><a href=\"index.php?controller=PrestamoController&action=editar&id=" . urlencode($id_prestamo) . "\">Volver</a></p>";
            exit;
        }
        header('Location: index.php?controller=PrestamoController&action=index');
    }
    public function eliminar() {
        if (!isset($_GET['id'])) {
            header('Location: index.php?controller=PrestamoController&action=index');
            exit;
        }
        $id = $_GET['id'];
        $this->model->deletePrestamo($id);
        header('Location: index.php?controller=PrestamoController&action=index');
    }
    public function detalle() {
        if (!isset($_GET['id'])) {
            header('Location: index.php?controller=PrestamoController&action=index');
            exit;
        }
        $id = $_GET['id'];
        $prestamo = $this->model->getPrestamoById($id);
        require_once __DIR__ . '/../views/prestamo/detalle.php';
    }
}
?>