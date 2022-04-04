<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;
use App\Models\RolesModel;
use App\Models\CajasModel;

class Usuarios extends BaseController
{
    protected $conectar;

    /*----------------------------------------------------------------------------------------------------Constructor de conecciones */
    public function __construct()
    {
        $this->conectar = new UsuariosModel();
        $this->caja = new CajasModel();
        $this->roles = new RolesModel();
    }
    /*----------------------------------------------------------------------------------------------------Inicio */
    public function index($activo = 1)
    {
        $conectar = $this->conectar->where("activo", $activo)->findAll();
        $data = ['titulo' => 'Lista de Usuarios', 'datos' => $conectar];
        return view('usuarios/usuarios', $data);
    }

    /*----------------------------------------------------------------------------------------------------Nuevo */
    public function nuevo()
    {
        $roles = $this->roles->where("activo", 1)->findAll();
        $cajas = $this->caja->where("activo", 1)->findAll();
        $data = ['titulo' => 'Agregar Usuario', 'roles' => $roles, 'cajas' => $cajas,];
        return view('usuarios/nuevo', $data);
    }


    /*----------------------------------------------------------------------------------------------------Eliminado */
    public function eliminado($activo = 0)
    {
        $conectar = $this->conectar->where("activo", $activo)->findAll();
        $data = ['titulo' => 'Lista de Usuarios Desactivados', 'datos' => $conectar];
        return view('usuarios/eliminado', $data);
    }

    /*----------------------------------------------------------------------------------------------------Editar */
    public function editar($id = null)
    {
        $id = $this->request->getVar('id');
        $roles = $this->roles->where("activo", 1)->findAll();
        $cajas = $this->caja->where("activo", 1)->findAll();
        $conectar = $this->conectar->where('id', $id)->first();
        $data = ['titulo' => 'Actualizar Usuario', 'datos' => $conectar, 'roles' => $roles, 'cajas' => $cajas,];
        return view('usuarios/editar', $data);
    }
    /*----------------------------------------------------------------------------------------------------Guardar */
    public function guardar()
    {
        $validation = service('validation');
        $validation->setRules(['usuario' => 'required|string|min_length[3]', 'password' => 'required|string|min_length[3]', 'rppassword' => 'required|matches[password]', 'nombre' => 'required|string|min_length[3]', 'rol' => 'required|alpha_numeric', 'caja' => 'required|alpha_numeric',]);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->with('errors', $validation->getErrors());
        } else {
            $hash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            $data = ['usuario' => $this->request->getPost('usuario'), 'password' => $hash, 'nombre' => $this->request->getPost('nombre'), 'id_rol' => $this->request->getPost('rol'), 'id_caja' => $this->request->getPost('caja'),];
            $this->conectar->save($data);
            return redirect()->to(base_url() . '/usuarios');
        }
    }
    /*----------------------------------------------------------------------------------------------------Actualizar */
    public function actualizar($id = null)
    {
        $id = $this->request->getVar('id');
        $validation = service('validation');
        $validation->setRules(['usuario' => 'required|string|min_length[3]', 'password' => 'required|string|min_length[3]', 'rppassword' => 'required|matches[password]', 'nombre' => 'required|string|min_length[3]', 'rol' => 'required|alpha_numeric', 'caja' => 'required|alpha_numeric']);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to(base_url() . '/usuarios/editar')->withInput()->with('errors', $validation->getErrors()); //No Logro arreglar que devuelva los datos

        } else {
            $hash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            $data = ['usuario' => $this->request->getPost('usuario'), 'password' => $hash, 'nombre' => $this->request->getPost('nombre'), 'id_rol' => $this->request->getPost('rol'), 'id_caja' => $this->request->getPost('caja'),];
            $this->conectar->update($id, $data);
            $conectar = $this->conectar->where('id', $id)->first();
            $roles = $this->roles->where("activo", 1)->findAll();
            $cajas = $this->caja->where("activo", 1)->findAll();
            $usuarios = ['titulo' => 'Cambiar la contraseña', 'datos' => $conectar, 'roles' => $roles, 'cajas' => $cajas, 'mensaje' => 'La contraseña ha sido actualizada satisfactoriamente'];
            return view('/usuarios/editar', $usuarios);
        }
    }

    /*----------------------------------------------------------------------------------------------------Eliminar */
    public function eliminar($id = null)
    {
        $this->conectar->update($id, ['activo' => 0]);
        return redirect()->to(base_url() . '/usuarios');
    }

    /*----------------------------------------------------------------------------------------------------Activar */
    public function activar($id = null)
    {
        $this->conectar->update($id, ['activo' => 1]);
        return redirect()->to(base_url() . '/usuarios/eliminado');
    }

    /*----------------------------------------------------------------------------------------------------Login */
    public function login()
    {
        $data = [
            'titulo' => 'Iniciar Sesion'
        ];
        return view('login', $data);
    }

    /*----------------------------------------------------------------------------------------------------Validar */
    public function valida()
    {
        $validation = service('validation');
        $validation->setRules(['usuario' => 'required|string|min_length[3]', 'password' => 'required|string|min_length[3]',]);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        } else {
            $usuario = $this->request->getPost('usuario');
            $password = $this->request->getPost('password');
            $datosUsuario = $this->conectar->where('usuario', $usuario)->first();
            if ($datosUsuario != null) {
                if (password_verify($password, $datosUsuario['password'])) {
                    $datosSesion = ['id_usuario' => $datosUsuario['id'], 'nombre' => $datosUsuario['nombre'], 'id_caja' => $datosUsuario['id_caja'], 'id_rol' => $datosUsuario['id_rol'],];
                    $session = session();
                    $session->set($datosSesion);
                    return redirect()->to(base_url() . '/configuracion');
                } else {
                    $data = ['error' => 'Contraseña Incorrecta', 'titulo' => 'Iniciar Sesion', 'user_session' => session()];
                    return view('login', $data);
                };
            } else {
                $data = ['error' => 'El usuario no existe', 'titulo' => 'Iniciar Sesion'];
                return view('login', $data);
            }
        }
    }

    /*----------------------------------------------------------------------------------------------------LogOut */
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('login'));
    }

    /*----------------------------------------------------------------------------------------------------Cambiar Password */
    public function cambiar_password()
    {
        $session = session();
        $idUsuario = $session->id_usuario;
        $conectar = $this->conectar->where('id', $idUsuario)->first();
        $data = ['titulo' => 'Cambiar la contraseña', 'datos' => $conectar,];
        return view('usuarios/cambia_password', $data);
    }

    /*----------------------------------------------------------------------------------------------------Actualizar Password */

    public function actualizar_password()
    {
        $session = session();
        $idUsuario = $session->id_usuario;
        $validation = service('validation');
        $validation->setRules(['password' => 'required|string|min_length[3]', 'rppassword' => 'required|matches[password]',]);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to(base_url() . '/Front/cambiapassword')->withInput()->with('errors', $validation->getErrors());
        } else {

            $hash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            $this->conectar->update($idUsuario, ['password' => $hash]);
            $conectar = $this->conectar->where('id', $idUsuario)->first();
            $data = ['titulo' => 'Cambiar la contraseña', 'datos' => $conectar, 'mensaje' => 'La contraseña ha sido actualizada satisfactoriamente'];
            return view('usuarios/cambia_password', $data);
        }
    }
}
