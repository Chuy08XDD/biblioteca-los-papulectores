<?php
// Front Controller - Maneja todas las rutas
session_start();

// Cargar automáticamente los controladores
function cargarControlador($controller) {
    $controllerFile = '../controllers/' . $controller . '.php';
    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        return new $controller();
    }
    return null;
}

// Obtener controller y action de la URL
$controllerName = $_GET['controller'] ?? 'LibroController';
$action = $_GET['action'] ?? 'index';

// Cargar el controlador
$controller = cargarControlador($controllerName);

// alumnos
$controllerName = $_GET['controller'] ?? 'PrestamoController';
$action = $_GET['action'] ?? 'index';

// 
$controller = cargarControlador($controllerName);

// carreras
$controllerName = $_GET['controller'] ?? 'UsuarioController';
$action = $_GET['action'] ?? 'index';

// 
$controller = cargarControlador($controllerName);

if ($controller && method_exists($controller, $action)) {
    $controller->$action();
} else {
    // Página de error 404
    http_response_code(404);
    echo "<h1>Error 404 - Página no encontrada</h1>";
    echo "<p>El controlador o acción solicitada no existe mal por ti imbe-.</p>";
}
?>