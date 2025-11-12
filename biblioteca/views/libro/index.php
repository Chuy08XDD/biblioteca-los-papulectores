<?php require_once __DIR__ . '/../layouts/header.php'; ?> <!--esto que carajos es es nuestro header que creamos modifiquen la ruta si no siguieron mis instrucciones, tanto nuestro header como nuestro footer seran traidos a todas nuestras vistas de esta manera-->

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2> Lista de Libros </h2>
    <a href="index.php?controller=LibroController&action=crear" class="btn btn-primary">Agregar Libro</a>
</div>
<table class="table table-striped table-dark">
    <thead>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Año de Publicación</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($libros as $libro): ?>
            <tr>
                <td><?php echo htmlspecialchars($libro['id_libro']); ?></td>
                <td><?php echo htmlspecialchars($libro['titulo']); ?></td>
                <td><?php echo htmlspecialchars($libro['autor']); ?></td>
                <td><?php echo htmlspecialchars($libro['año_publicacion']); ?></td>
                <td>
                    <a href="index.php?controller=LibroController&action=editar&id=<?php echo $libro['id_libro']; ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="index.php?controller=LibroController&action=eliminar&id=<?php echo $libro['id_libro']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este libro?');">Callese y borrelo</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?> <!--y este nuestro footer-->