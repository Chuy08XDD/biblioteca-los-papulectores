<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<h2> Editar datos del usuario </h2>

<form method="POST" action="index.php?controller=UsuarioController&action=actualizar">
    <input type="hidden" name="id" value="<?php echo $usuario['id_usuario']; ?>">
    <div>
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text"  class="form-control" id="nombre" name="nombre" value="<?php echo $usuario['nombre']; ?>" required>
    </div>
    <div>
        <label for="correo" class="form-label">Correo:</label>
        <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $usuario['correo']; ?>" required>
    </div>
    <div>
        <label for="telefono" class="form-label">Teléfono:</label>
        <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $usuario['telefono']; ?>" required>
    </div>
        <button type="submit" class="btn btn-success">Actualizar Usuario</button>
           <button type="button" onclick="window.location.href='index.php?controller=UsuarioController&action=index'" class="btn btn-secondary">Cancelar</button>
</form>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>