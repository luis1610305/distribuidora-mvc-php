<?php 
namespace Controllers;

use MVC\Router;
use Model\Producto;

class ProductoController {
    public static function index(Router $router) {
        isAuth();
        $productos = Producto::all();

        $router->render('admin/productos/index', [
            'productos' => $productos
        ]);
    }

    public static function crear(Router $router) {
        isAuth();
        $producto = New Producto;
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $producto->sincronizar($_POST);
            $alertas = $producto->validar();

            if(empty($alertas)) {
                $producto->guardar();
                header('Location: /admin/productos');
            }
        }

        $router->render('admin/productos/crear', [
            'producto' => $producto,
            'alertas' => $alertas
        ]);
    }

    public static function actualizar(Router $router) {
        isAuth();
        if(!is_numeric($_GET['id']));
        $id = $_GET['id'];

        $producto = Producto::find($id);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $producto->sincronizar($_POST);
            $alertas = $producto->validar();

            if(empty($alertas)) {
                $producto->guardar();
                header('Location: /admin/productos');
            }
        }
        $router->render('admin/productos/actualizar', [
            'producto' => $producto,
            'alertas' => $alertas
        ]);
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $producto = Producto::find($id);
            $producto->eliminar();
            header('Location: /productos');
        }
    }

    public static function buscador() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $palabra = $_POST['palabra'];
            header("Location: /productos/producto?palabra=$palabra");
        }
    }

    public static function producto(Router $router) {
        $palabra = $_GET['palabra'];
        $query = "SELECT * FROM productos WHERE codigo LIKE '$palabra' OR descripcion like '%$palabra%'";
        $productos = Producto::SQL($query);

        $router->render('productos/producto', [
            'productos' => $productos
        ]);
    }
}