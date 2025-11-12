<?php
require_once __DIR__ . '/../model/UsuarioModel.php';

class UsuarioController {
    private $model;
    public function __construct() {
        $this->model = new UsuarioModel();
    }
    public function index() {
        $usuarios = $this->model->getAllUsuarios();
        require_once __DIR__ . '/../views/usuario/index.php';
    }
    public function crear() {
        require_once __DIR__ . '/../views/usuario/crear.php';
    }
    public function guardar() {
        // Validar campos requeridos
        $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
        $email = isset($_POST['correo']) ? trim($_POST['correo']) : '';
        $telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';

        if ($nombre === '' || $email === '') {
            // Campos obligatorios faltantes: volver al formulario
            header('Location: index.php?controller=UsuarioController&action=crear');
            exit;
        }

        $this->model->createUsuario($nombre, $email, $telefono);
        header('Location: index.php?controller=UsuarioController&action=index');
    }
    public function editar() {
        // Esperamos recibir el id como 'id' desde la vista
        if (!isset($_GET['id'])) {
            header('Location: index.php?controller=UsuarioController&action=index');
            exit;
        }
        $id = $_GET['id'];
        $usuario = $this->model->getUsuarioById($id);
        require_once __DIR__ . '/../views/usuario/editar.php';
    }
    public function actualizar() {
        // Asegurarse de recibir el id y los campos
        if (!isset($_POST['id'])) {
            header('Location: index.php?controller=UsuarioController&action=index');
            exit;
        }
        $id = $_POST['id'];
        $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
        $email = isset($_POST['correo']) ? trim($_POST['correo']) : '';
        $telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';

        if ($nombre === '' || $email === '') {
            // Datos incompletos: volver al formulario de edición
            header('Location: index.php?controller=UsuarioController&action=editar&id=' . urlencode($id));
            exit;
        }

        $this->model->updateUsuario($id, $nombre, $email, $telefono);
        header('Location: index.php?controller=UsuarioController&action=index');
    }
    public function eliminar() {
        $id = $_GET['id'];
        $this->model->deleteUsuario($id);
        header('Location: index.php?controller=UsuarioController&action=index');
    }
}
?> <!--fijense como es que hace esta comunicacion con nuestro modelo-->