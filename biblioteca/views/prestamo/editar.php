<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h2> Editar datos del prestamo </h2>

<form method="POST" action="index.php?controller=PrestamoController&action=actualizar">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($prestamo['id_prestamo']); ?>">
    <div>
        <label for="id_libro" class="form-label">ID del Libro:</label>
        <input type="text" class="form-control" id="id_libro" name="id_libro" value="<?php echo $prestamo['id_libro']; ?>" required>
    </div>
    <div>
        <label for="id_usuario" class="form-label">ID del Usuario:</label>
        <input type="text" class="form-control" id="id_usuario" name="id_usuario" value="<?php echo $prestamo['id_usuario']; ?>" required>
    </div>
    <div>
        <label for="cantidad" class="form-label">Cantidad de libros prestados:</label>
        <input type="number" class="form-control" id="cantidad" name="cantidad" value="<?php echo $prestamo['cantidad']; ?>" required>
    </div>
    <div>
        <label for="fecha_prestamo" class="form-label">Fecha de Préstamo:</label>
        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo $prestamo['fecha_inicio']; ?>" required>
    </div>
    <div>
        <label for="fecha_devolucion" class="form-label">Fecha de Devolución:</label>
        <input type="date" class="form-control" id="devolucion" name="devolucion" value="<?php echo $prestamo['devolucion']; ?>" required>
    </div>
    <div>
    <label for="estado" class="form-label">Estado:</label>
    <select class="form-control" id="estado" name="estado" required>
        <option value="VIGENTE" <?= $prestamo['estado'] == 'VIGENTE' ? 'selected' : '' ?>>VIGENTE</option>
        <option value="DEVUELTO" <?= $prestamo['estado'] == 'DEVUELTO' ? 'selected' : '' ?>>DEVUELTO</option>
        <option value="RETRASADO" <?= $prestamo['estado'] == 'RETRASADO' ? 'selected' : '' ?>>RETRASADO</option>
    </select>
    </div>
        <button type="submit" class="btn btn-success">Actualizar Prestamo</button>
        <button type="button" onclick="window.location.href='index.php?controller=PrestamoController&action=index'" class="btn btn-secondary">Cancelar</button>
</form>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>