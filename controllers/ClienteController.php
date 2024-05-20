<?php
namespace Controllers;

use MVC\Router;
use Model\Cliente;
use Model\Distrito;

class ClienteController {
    public static function index(Router $router) {
        isAuth();

        //Consultar a la base de datos
        $query = "select clientes.id, clientes.nombre, clientes.correo, clientes.telefono, clientes.direccion, clientes.distritoId, distritos.distrito from clientes ";
        $query .= " LEFT OUTER JOIN distritos";
        $query .= " ON clientes.distritoId = distritos.id;";

        $clientes = Cliente::SQL($query);

        $router->render('admin/clientes/index', [
            'clientes' => $clientes
        ]) ;
    }

    public static function crear(Router $router) {
        isAuth();
        $cliente = New Cliente;
        $alertas = [];

        $distritos = Distrito::all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cliente->sincronizar($_POST);
            $alertas = $cliente->validarCliente();

            if (empty($alertas)) {
                $cliente->guardar();
                header('Location: /admin/clientes');
            }
        }

        $router->render('admin/clientes/crear', [
            'cliente' => $cliente,
            'distritos' => $distritos,
            'alertas' => $alertas
        ]);
    }

    public static function actualizar(Router $router) {
        isAuth();

        if(!is_numeric($_GET['id']));
        $id = $_GET['id'];
        $cliente = Cliente::find($id);

        $distritos = Distrito::all();

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cliente->sincronizar($_POST);
            $alertas = $cliente->validar();

            if(empty($alertas)) {
                $cliente->guardar();
                header('Location: /admin/clientes');
            }
        }

        $router->render('admin/clientes/actualizar', [
            'cliente' => $cliente,
            'distritos' => $distritos,
            'alertas' => $alertas
        ]);
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $cliente = Cliente::find($id);
            $cliente->eliminar();
            header('Location: /clientes');
        }
    }

    public static function buscador() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            header("Location: /clientes/cliente?nombre=$nombre");
        }
        
    }

    public static function cliente(Router $router) {
        isAuth();

        $nombre = $_GET['nombre'];
        $query = "SELECT clientes.id, clientes.correo, clientes.nombre, clientes.telefono, clientes.direccion, distritos.distrito as distritoId, zonas.zona as zonaId FROM clientes";
        $query .= " LEFT OUTER JOIN distritos";
        $query .= " ON clientes.distritoId = distritos.id";
        $query .= " LEFT OUTER JOIN zonas";
        $query .= " ON clientes.zonaId = zonas.id";
        $query .= " WHERE nombre like '%$nombre%'";

        $clientes = Cliente::SQL($query);

        $router->render('clientes/cliente', [
            'clientes' => $clientes,
        ]);
    }
}