<?php require_once __DIR__ . '/../layouts/header.php'; ?>
añade al alma en pena
<h2> Agregar nuevo usuario </h2>

<form method="POST" action="index.php?controller=UsuarioController&action=guardar">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
    </div>
        <div class="mb-3">
            <label for="correo" class="form-label">Correo:</label>
            <input type="email" class="form-control" id="correo" name="correo" required>
        </div>
    <div class="mb-3">
        <label for="telefono" class="form-label">Teléfono:</label>
        <input type="text" class="form-control" id="telefono" name="telefono" required>
    </div>
    <div>
        <button type="submit" class="btn btn-success">Guardar Usuario</button>
        <a href="index.php?controller=UsuarioController&action=index" class="btn btn-secondary">Cancelar</a>
    </div>  
</form>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>