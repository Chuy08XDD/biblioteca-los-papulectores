<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h2> Editar Libro </h2>

<form method="POST" action="index.php?controller=LibroController&action=actualizar">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($libro['id_libro']); ?>">
    <div class="mb-3">
        <label for="titulo" class="form-label"> Título </label>
        <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo htmlspecialchars($libro['titulo']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="autor" class="form-label"> Autor </label>
        <input type="text" class="form-control" id="autor" name="autor" value="<?php echo htmlspecialchars($libro['autor']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="año_publicacion" class="form-label"> Año de Publicación </label>
        <input type="number" class="form-control" id="año_publicacion" name="año_publicacion" value="<?php echo htmlspecialchars($libro['año_publicacion']); ?>" required>
    </div>
    <button type="submit" class="btn btn-success">Actualizar</button>
    <a href="index.php?controller=LibroController&action=index" class="btn btn-secondary">Cancelar</a>
</form>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
