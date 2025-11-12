<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca los papulectores - MVC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-brand { font-weight: bold; }
        .hero { background: linear-gradient(135deg, #6f79a7ff 0%, #6c696eff 100%); color: white; padding: 60px 0; }
        .html, body {
            color: #ffffff;
            margin: 0;
            padding: 0;
            background-color: #6e7286ff;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php"> BIBLIOTECA LOS PAPULECTORES </a>
            <div class="navbar-nav">
                <a class="nav-link text-white" href="index.php?controller=UsuarioController&action=index">Usuarios</a>
                <a class="nav-link text-white" href="index.php?controller=LibroController&action=index">Libros Disponibles</a>
                <a class="nav-link text-white" href="index.php?controller=PrestamoController&action=index">Prestamos</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">Operación realizada bien felicidades mi tontin ahora eres pro</div>
        <?php endif; ?>
        
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">Error al realizar la operación womp womp pedazo de down</div>
        <?php endif; ?>