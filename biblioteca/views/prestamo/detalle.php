<?php
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../../model/LibroModel.php';
require_once __DIR__ . '/../../model/UsuarioModel.php';

$libroModel = new LibroModel();
$usuarioModel = new UsuarioModel();

$libro = $libroModel->getLibroById($prestamo['id_libro']);
$usuario = $usuarioModel->getUsuarioById($prestamo['id_usuario']);
?>

<h2> Detalle del Préstamo </h2>
<form method="GET" action="index.php?controller=PrestamoController&action=index">
    <button type="submit" class="btn btn-secondary mb-3">Volver a la lista de préstamos</button>
</form>
<table class="table table-bordered table-dark">
    <tr>
        <th>ID del Préstamo</th>
        <td><?php echo htmlspecialchars($prestamo['id_prestamo']); ?></td>
    </tr>
    <tr>
        <th>Título del Libro</th>
        <td><?php echo htmlspecialchars($libro['titulo']); ?></td>
    </tr>
    <tr>
        <th>Nombre del Usuario</th>
        <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
    </tr>
    <tr>
        <th>Cantidad de Libros Prestados</th>
        <td><?php echo htmlspecialchars($prestamo['cantidad']); ?></td>
    </tr>
    <tr>
        <th>Fecha de Préstamo</th>
        <td><?php echo htmlspecialchars($prestamo['fecha_inicio']); ?></td>
    </tr>
    <tr>
        <th>Fecha de Devolución</th>
        <td><?php echo htmlspecialchars($prestamo['devolucion']); ?></td>
    </tr>
    <tr>
        <th>Estado</th>
        <td><?php echo htmlspecialchars($prestamo['estado']); ?></td>
    </tr>
</table>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>