<?php

namespace Controllers;

use MVC\Router;
use Classes\Email;
use Model\Distrito;
use Model\Usuario;

class LoginController
{
    public static function login(Router $router)
    {
        $usuario = new Usuario;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);

            $alertas = $usuario->validarLogin();

            if (empty($alertas)) {
                //Verificar que el usuario exista
                $usuario = Usuario::where('correo', $usuario->correo);

                if (!$usuario || !$usuario->confirmado) {
                    Usuario::setAlerta('error', 'El Usuario no existe o no está confirmado');
                } else {
                    //El Usuario existe 
                    if (password_verify($_POST['password'], $usuario->password)) {
                        //Iniciar Sesion
                        session_start();

                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['login'] = true;

                        header('Location: /admin/productos');
                    } else {
                        Usuario::setAlerta('error', 'El Password es incorrecto');
                    }
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('admin/auth/login', [
            'titulo' => 'Iniciar Sesión',
            'alertas' => $alertas,
            'usuario' => $usuario
        ]);
    }

    public static function logout()
    {
        session_start();

        $_SESSION = [];
        header('Location: /');
    }

    public static function crear(Router $router)
    {
        $usuario = new Usuario;
        $alertas =  [];
        $distritos = Distrito::all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            if (empty($alertas)) {
                $existeUsuario = Usuario::where('correo', $usuario->correo);

                if ($existeUsuario) {
                    Usuario::setAlerta('error', 'El Usuario ya está registrado');
                    $alertas = Usuario::getAlertas();
                } else {
                    //Hashear Password
                    $usuario->hashPassword();

                    //Eliminar password2
                    unset($usuario->password2);

                    //Generar Token
                    $usuario->crearToken();

                    //Crear un nuevo usuario
                    $resultado = $usuario->guardar();

                    //Enviar Email
                    $email = new Email($usuario->correo, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();

                    if ($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }
        }

        $router->render('admin/auth/crear', [
            'titulo' => 'Crea tu Usuario',
            'usuario' => $usuario,
            'alertas' => $alertas,
            'distritos' => $distritos
        ]);
    }

    public static function mensaje(Router $router)
    {
        $router->render('admin/auth/mensaje', [
            'titulo' => 'Cuenta Creada Exitosamente'
        ]);
    }

    public static function confirmar(Router $router)
    {
        $token = s($_GET['token']);

        if (!$token) {
            header('Location: /');
        }

        //Encontrar al usuario con este token
        $usuario = Usuario::where('token', $token);

        if (empty($usuario)) {
            Usuario::setAlerta('error', 'Token No Válido');
        } else {
            //Confirmar la cuenta
            $usuario->confirmado = 1;
            $usuario->token = null;
            unset($usuario->password2);

            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta Comprobada Correctamente');
        }

        $alertas = Usuario::getAlertas();

        $router->render('admin/auth/confirmar', [
            'titulo' => 'Confirmar tu cuenta',
            'alertas' => $alertas
        ]);
    }

    public static function olvide(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();

            if (empty($alertas)) {
                $usuario = Usuario::where('correo', $usuario->correo);

                if ($usuario && $usuario->confirmado == 1) {
                    //Usuario encontrado
                    $usuario->crearToken();
                    unset($usuario->password2);

                    $usuario->guardar();

                    $email = new Email($usuario->correo, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();

                    Usuario::setAlerta('exito', 'Hemos enviado las instrucciones a tu email');
                } else {
                    Usuario::setAlerta('error', 'Usuario no existe o no está confirmado');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('admin/auth/olvide', [
            'titulo'  => 'Olvidé mi Password',
            'alertas' => $alertas
        ]);
    }

    public static function reestablecer(Router $router)
    {
        $token = s($_GET['token']);
        $mostrar = true;

        if (!$token) {
            header('Location: /');
        }

        //Identificar al usuario con este token
        $usuario = Usuario::where('token', $token);

        if (empty($usuario)) {
            Usuario::setAlerta('error', 'Token No Válido');
            $mostrar = false;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Añadir Nuevo Password
            $usuario->sincronizar($_POST);

            //validar Password
            $alertas = $usuario->validarPassword();

            if (empty($alertas)) {
                $usuario->hashPassword();

                $usuario->token = null;
                unset($usuario->password2);

                $resultado = $usuario->guardar();

                if ($resultado) {
                    header('Location: /');
                }
            }

            $alertas = Usuario::getAlertas();

        }

        $router->render('admin/auth/reestablecer', [
            'titulo' => 'Reestablecer Password',
            'alertas' => $alertas,
            'mostrar' => $mostrar
        ]);
    }
}
