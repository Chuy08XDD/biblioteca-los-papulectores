<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h2> Añadir nuevo prestamo </h2>

<form method="POST" action="index.php?controller=PrestamoController&action=guardar">
    <div class="mb-3">
        <label for="id_libro" class="form-label">Libro prestado</label>
        <select class="form-control" id="id_libro" name="id_libro" required>
            <option value="">-- Seleccione un libro --</option>
            <?php foreach ($libros as $libro): ?>
                <option value="<?php echo htmlspecialchars($libro['id_libro']); ?>"><?php echo htmlspecialchars($libro['titulo']); ?> (ID: <?php echo htmlspecialchars($libro['id_libro']); ?>)</option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="id_usuario" class="form-label">Usuario</label>
        <select class="form-control" id="id_usuario" name="id_usuario" required>
            <option value="">-- Seleccione un usuario --</option>
            <?php foreach ($usuarios as $usuario): ?>
                <option value="<?php echo htmlspecialchars($usuario['id_usuario']); ?>"><?php echo htmlspecialchars($usuario['nombre']); ?> &lt;<?php echo htmlspecialchars($usuario['correo']); ?>&gt; (ID: <?php echo htmlspecialchars($usuario['id_usuario']); ?>)</option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="cantidad" class="form-label">Cantidad de libros prestados:</label>
        <input type="number" class="form-control" id="cantidad" name="cantidad" min="1" required>
    </div>
    <div class="mb-3">
        <label for="fecha_inicio" class="form-label">Fecha de Préstamo:</label>
        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required value="<?= date('Y-m-d') ?>">
    </div>
    <div class="mb-3">
        <label for="fecha_devolucion" class="form-label">Fecha de Devolución:</label>
        <input type="date" class="form-control" id="devolucion" name="devolucion" required value="<?= date('Y-m-d') ?>">
    </div>
    <select class="form-control" name="estado" required>
                    <option value="VIGENTE">VIGENTE</option>
                    <option value="DEVUELTO">DEVUELTO</option>
                    <option value="RETRASADO">RETRASADO</option>
                </select>
    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="index.php?controller=PrestamoController&action=index" class="btn btn-secondary">Cancelar</a>
    </div>
</form>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>