<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Gestión de Prestamos</h2>
    <a href="index.php?controller=PrestamoController&action=crear" class="btn btn-primary"> Agregar Prestamo</a>
</div>
<table class="table table-striped table-dark">
    <thead>
        <tr>
            <th>ID del prestamo</th>
            <th>ID del Libro</th>
            <th>ID del Usuario</th>
            <th>Fecha de Préstamo</th>
            <th>Fecha de Devolución</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($prestamos as $prestamo): ?>
            <tr>
                <td><?php echo $prestamo['id_prestamo']; ?></td>
                <td><?php echo $prestamo['id_libro']; ?></td>
                <td><?php echo $prestamo['id_usuario']; ?></td>
                <td><?php echo $prestamo['fecha_inicio']; ?></td>
                <td><?php echo $prestamo['devolucion']; ?></td>
                <td><?php echo $prestamo['estado']; ?></td>
                <td>
                    <a href="index.php?controller=PrestamoController&action=editar&id=<?php echo $prestamo['id_prestamo']; ?>" class="btn btn-sm btn-warning">Editar</a>
                    <a href="index.php?controller=PrestamoController&action=eliminar&id=<?php echo $prestamo['id_prestamo']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este prestamo?');">borrate tamare</a>
                    <a href="index.php?controller=PrestamoController&action=detalle&id=<?php echo $prestamo['id_prestamo']; ?>" class="btn btn-sm btn-info">Detalles</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>