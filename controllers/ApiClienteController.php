<?php

namespace Controllers;

use Model\Cliente;


class ApiClienteController
{

    public static function index()
    {
        //Consultar a la base de datos
        $query = "SELECT clientes.id, clientes.correo, clientes.nombre, clientes.telefono, clientes.direccion, clientes.distritoId, distritos.distrito FROM clientes";
        $query .= " LEFT OUTER JOIN distritos";
        $query .= " ON clientes.distritoId = distritos.id;";

        $clientes = Cliente::SQL($query);

        $resultado = [
            'clientes' => $clientes
        ];

        echo json_encode($resultado);
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //validar que el cliente exista
            $id = $_POST['id'];
            $cliente = Cliente::where('id', $id);

            if (!$cliente) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un error al eliminar el cliente'
                ];
                echo json_encode($respuesta);
                return;
            }

            $cliente = Cliente::find($id);
            $resultado = $cliente->eliminar();

            if ($resultado) {
                $respuesta = [
                    'tipo' => 'exito',
                    'mensaje' => 'Cliente Eliminado Correctamente'
                ];

                echo json_encode($respuesta);
            }
        }
    }
}
