<?php
require_once __DIR__ . '/../model/LibroModel.php';

class LibroController {
    private $model;

    public function __construct() {
        $this->model = new LibroModel();
    }
    public function index() {
        $libros = $this->model->getAllLibros();
        require_once __DIR__ . '/../views/libro/index.php';
    }
    public function crear() {
        require_once __DIR__ . '/../views/libro/create.php';
    }
    public function guardar() {
        if (!isset($_POST['titulo'], $_POST['autor'], $_POST['año_publicacion'])) {
            header('Location: index.php?controller=LibroController&action=crear');
            exit;
        }
        $titulo = trim($_POST['titulo']);
        $autor = trim($_POST['autor']);
        $año = trim($_POST['año_publicacion']);
        
        if ($titulo === '' || $autor === '') {
            header('Location: index.php?controller=LibroController&action=crear');
            exit;
        }
        
        $this->model->createLibro($titulo, $autor, $año);
        header('Location: index.php?controller=LibroController&action=index');
    }
    public function editar() {
        if (!isset($_GET['id'])) {
            header('Location: index.php?controller=LibroController&action=index');
            exit;
        }
        $id = $_GET['id'];
        $libro = $this->model->getLibroById($id);
        require_once __DIR__ . '/../views/libro/edit.php';
    }
    public function actualizar() {
        if (!isset($_POST['id'], $_POST['titulo'], $_POST['autor'], $_POST['año_publicacion'])) {
            header('Location: index.php?controller=LibroController&action=index');
            exit;
        }
        $id = $_POST['id'];
        $titulo = trim($_POST['titulo']);
        $autor = trim($_POST['autor']);
        $año = trim($_POST['año_publicacion']);
        
        if ($titulo === '' || $autor === '') {
            header('Location: index.php?controller=LibroController&action=editar&id=' . urlencode($id));
            exit;
        }
        
        $this->model->updateLibro($id, $titulo, $autor, $año);
        header('Location: index.php?controller=LibroController&action=index');
    }
    public function eliminar() {
        if (!isset($_GET['id'])) {
            header('Location: index.php?controller=LibroController&action=index');
            exit;
        }
        $id = $_GET['id'];
        $this->model->deleteLibro($id);
        header('Location: index.php?controller=LibroController&action=index');
    }
    public function view($id) {
        $libro = $this->model->getLibroById($id);
        require_once __DIR__ . '/../views/libro/view.php';
    }
}
?>