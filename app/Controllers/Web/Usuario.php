<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;


class Usuario extends BaseController
{
    public function index()
    {
        //
    }
    function createUser()
    {
        $usuarioModel = new UsuarioModel();
        $usuarioModel->insert([
            'usuario' => 'admin',
            'email' => 'admin@gmail.com',
            'contrasena' => $usuarioModel->contrasenaHash('12345'),
        ]);
    }

    public function login()
    {
        echo view('web/usuario/login');
    }

    public function login_post()
    {
        $usuarioModel = new UsuarioModel();

        $email = $this->request->getPost('email'); //emial or usuario
        $contrasena = $this->request->getPost('contrasena');

        $usuario = $usuarioModel->select('id, usuario, email, contrasena, tipo')
            ->orWhere('email', $email)
            ->orWhere('usuario', $email)
            ->first();
        if (!$usuario) {
            return redirect()->back()->with('message', 'Usuario y/o contraseña incorrectos');
        }
        if ($usuarioModel->contrasenaVerify($contrasena, $usuario->contrasena)) {
            // Login successful
            unset($usuario->contrasena); // Remove password from session data
            session()->set('usuario', $usuario);

            return redirect()->to('/dashboard/categoria')->with('message', "Bienvenid@ $usuario->usuario"); // Redirect to dashboard
        } else {
            // Login failed
            return redirect()->back()->with('message', 'Usuario y/o contraseña incorrectos');
        }
    }

    public function register()
    {
        echo view('web/usuario/register');
    }

    public function register_post()
    {
        $usuarioModel = new UsuarioModel();

        if ($this->validate('usuarios')) {
            $usuarioModel->insert([
                'usuario' => $this->request->getPost('usuario'),
                'email' => $this->request->getPost('email'),
                'contrasena' => $usuarioModel->contrasenaHash($this->request->getPost('contrasena')),
            ]);
            return redirect()->to(route_to('usuario.login'))->with('message', 'Usuario creado correctamente, ya puedes iniciar sesión');
        }
        session()->setFlashdata([
            'validation' => $this->validator
        ]);

        return redirect()->back()->withInput();
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to(route_to('usuario.login'))->with('message', 'Sesión cerrada correctamente');
    }
}
