<?php

use MVC\Router;
use Controllers\LoginController;
use Controllers\PedidoController;
use Controllers\ClienteController;
use Controllers\ProductoController;
use Controllers\ApiPedidoController;
use Controllers\ApiClienteController;
use Controllers\ApiProductoController;
require_once __DIR__ . '/../includes/app.php';

$router = new Router();

//Login
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

//Crear Cuenta
$router->get('/crear', [LoginController::class, 'crear']);
$router->post('/crear', [LoginController::class, 'crear']);

//Formulario de olvide mi password
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);

//Colocar el nuevo password
$router->get('/reestablecer', [LoginController::class, 'reestablecer']);
$router->post('/reestablecer', [LoginController::class, 'reestablecer']);

//confirmacion de cuenta
$router->get('/mensaje', [LoginController::class, 'mensaje']);
$router->get('/confirmar', [LoginController::class, 'confirmar']);

//Clientes
$router->get('/admin/clientes', [ClienteController::class, 'index']);
$router->get('/admin/clientes/crear', [ClienteController::class, 'crear']);
$router->post('/admin/clientes/crear', [ClienteController::class, 'crear']);
$router->get('/admin/clientes/actualizar', [ClienteController::class, 'actualizar']);
$router->post('/admin/clientes/actualizar', [ClienteController::class, 'actualizar']);
$router->post('/admin/clientes/eliminar', [ClienteController::class, 'eliminar']);
$router->get('/admin/clientes/cliente', [ClienteController::class, 'cliente']);
$router->post('/admin/clientes/buscador', [ClienteController::class, 'buscador']);

//API Clientes
$router->get('/api/clientes', [ApiCLienteController::class, 'index']);
$router->post('/api/cliente/eliminar', [ApiClienteController::class, 'eliminar']);

//Productos
$router->get('/admin/productos', [ProductoController::class, 'index']);
$router->get('/admin/productos/crear', [ProductoController::class, 'crear']);
$router->post('/admin/productos/crear', [ProductoController::class, 'crear']);
$router->get('/admin/productos/actualizar', [ProductoController::class, 'actualizar']);
$router->post('/admin/productos/actualizar', [ProductoController::class, 'actualizar']);
$router->post('/admin/productos/eliminar', [ProductoController::class, 'eliminar']);
$router->get('/admin/productos/producto', [ProductoController::class, 'producto']);
$router->post('/admin/productos/buscador', [ProductoController::class, 'buscador']);

//API Productos
$router->get('/api/productos', [ApiProductoController::class, 'index']);
$router->post('/api/producto/eliminar', [ApiProductoController::class, 'eliminar']);

//Pedidos
$router->get('/admin/pedidos', [PedidoController::class, 'index']);
$router->get('/admin/pedidos/crear', [PedidoController::class, 'crear']);
$router->get('/admin/pedidos/actualizar', [PedidoController::class, 'actualizar']);
$router->get('/admin/pedidos/pedido', [PedidoController::class, 'pedido']); 

//API Pedidos
$router->post('/api/pedido/obtenerProducto', [ApiPedidoController::class, 'obtenerProducto']);
$router->post('/api/pedido/crear', [ApiPedidoController::class, 'crear']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();