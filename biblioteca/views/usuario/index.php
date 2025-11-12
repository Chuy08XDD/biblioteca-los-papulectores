<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2> Gestión de Usuarios </h2>
        <a href="index.php?controller=UsuarioController&action=crear" class="btn btn-primary"> Agregar Usuario </a>
</div>
<table class="table table-striped table-dark">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?php echo $usuario['id_usuario']; ?></td>
                <td><?php echo $usuario['nombre']; ?></td>
                <td><?php echo $usuario['correo']; ?></td>
                <td><?php echo $usuario['telefono']; ?></td>
                <td>
                    <a href="index.php?controller=UsuarioController&action=editar&id=<?php echo $usuario['id_usuario']; ?>" class="btn btn-sm btn-warning">Editar</a>
                    <a href="index.php?controller=UsuarioController&action=eliminar&id=<?php echo $usuario['id_usuario']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">Borrate chucha jeje</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>