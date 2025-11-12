<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h2> Libro Nuevo </h2>

<form method="POST" action="index.php?controller=LibroController&action=guardar">
    <div class="mb-3">
        <Label for="titulo" class="form-label"> Título </label>
        <input type="text" class="form-control" id="titulo" name="titulo" required>
</div>
    <div class="mb-3">
        <Label for="autor" class="form-label"> Autor </label>
        <input type="text" class="form-control" id="autor" name="autor" required>
</div>
    <div class="mb-3">
        <Label for="año_publicacion" class="form-label"> Año de Publicación </label>
        <input type="date" class="form-control" id="año_publicacion" name="año_publicacion" required value="<?= date('Y-m-d') ?>">
</div>
    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="index.php?controller=LibroController&action=index" class="btn btn-secondary">Cancelar</a>
</form>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>